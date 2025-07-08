<?php

namespace App\Http\Controllers\Front;

use App\Models\Year;
use App\Models\Course;
use App\Models\Children;
use App\Models\Discount;
use App\Models\Enrollment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\ClientUpdateTransactionRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class TransactionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $check_done_payment = Transaction::where('user_id',auth()->user()->id)->where('status', 'Payment Receive')->first();
        $visible_testimonial = false;
        if ($check_done_payment) {
            $visible_testimonial = true;
        }

        $transactions = Transaction::where('user_id',auth()->user()->id)->paginate(10);
        // $transactions = Transaction::all();
        return view('frontend.transaction.index',compact('transactions','visible_testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $years = Year::all();
        $courses = Course::all();
        return view('frontend.transaction.create',compact('years', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();
        $errorMessages = $this->validateEnrollments($validated);
        if (!empty($errorMessages)) {
            return redirect()->back()->with('error', implode(' ', $errorMessages));
        }

        try {
            DB::beginTransaction();
            
            $discount = $this->handlePromoCode($validated['promo_code'] ?? null);
            
            // Validate enrollments first
           
            

            // Generate transaction number
            $transactionNo = $this->generateTransactionNumber();
            
            // Calculate total amount and prepare course data
            $courses = Course::whereIn('id', $validated['courses'])->get();
            $amount = $this->calculateTotalAmount($courses, $validated['child_id']);
            
            $totalAmount = 0;
            $discount_amount = 0;
            if ($discount) {
                if ($discount->type == 'percent') {
                    $totalAmount = $amount * $discount->total / 100;
                    $discount_amount = $amount - $totalAmount;
    
                } else {
                    $totalAmount -= $amount - $discount->total;
                    $discount_amount = $discount->total;
                }
            }else{
                $totalAmount = $amount;
            }
            // Create transaction
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'year_id' => $validated['year_id'],
                'transaction_no' => $transactionNo,
                'amount' => $totalAmount,
                'discount_id' => $discount ? $discount->id : null,
                'discount_amount' => $discount_amount,
            ]); 

            // Create transaction items in bulk
            $this->createTransactionItems($transaction, $validated['child_id'], $courses);

            DB::commit();
            return redirect()
                ->route('client.transaction.show', $transaction)
                ->with('success', 'Transaction Created Successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Transaction creation failed: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to create transaction. Please try again.');
        }
    }

    private function handlePromoCode(?string $promoCode)
    {
        if (!$promoCode) {
            return null;
        }

        return Discount::where('code', $promoCode)
            ->where('status', true)
            ->where('date_valid', '>=', now())
            ->first();

        
    }

    private function validateEnrollments(array $validated): array
    {
        $errorMessages = [];
        $children = Children::whereIn('id', $validated['child_id'])->get();
        
        $existingEnrollments = Enrollment::where('year_id', $validated['year_id'])
            ->whereIn('course_id', $validated['courses'])
            ->whereIn('children_id', $validated['child_id'])
            ->where('status', 'Approved')
            ->get();

        foreach ($existingEnrollments as $enrollment) {
            $child = $children->firstWhere('id', $enrollment->children_id);
            $errorMessages[] = "Siswa {$child->name} telah terdaftar dalam kelas pada tahun ini.";
        }

        return $errorMessages;
    }

    private function generateTransactionNumber(): string
    {
        $nowYear = date('Y');
        $lastTransaction = Transaction::latest()->first();
        
        if (!$lastTransaction) {
            return "TRX/{$nowYear}/00001";
        }
        
        $nextId = $lastTransaction->id + 1;
        return "TRX/{$nowYear}/" . str_pad($nextId, 5, '0', STR_PAD_LEFT);
    }

    private function calculateTotalAmount($courses, array $childIds): float
    {
        $coursesTotalPrice = $courses->sum('price');
        return $coursesTotalPrice * count($childIds);
    }

    private function createTransactionItems(Transaction $transaction, array $childIds, $courses): void
    {
        $items = [];
        foreach ($childIds as $childId) {
            foreach ($courses as $course) {
                $items[] = [
                    'transaction_id' => $transaction->id,
                    'children_id' => $childId,
                    'course_id' => $course->id,
                    'price' => $course->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        // Bulk insert all items at once
        TransactionItem::insert($items);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);
        return view('frontend.transaction.show',compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientUpdateTransactionRequest $request, Transaction $transaction)
    {
        $validate = $request->validated();

        if ($transaction->payment_image) {
            Storage::disk('public')->delete($transaction->payment_image);
        }

        $imagePath = $request->file('payment_image')->store('payment-image', 'public');
        $validate['payment_image'] = $imagePath;
        $transaction->update([
            'payment_image' => $validate['payment_image']
        ]);

// Suggested code may be subject to a license. Learn more: ~LicenseLog:2699959546.
        return redirect()->back()->with('success','Transaction Updated Successfully!');

    }

    public function set_pending(Transaction $transaction){
        $transaction->update([
            'status' => 'Pending'
        ]);
        return redirect()->back()->with('success','Transaction updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
