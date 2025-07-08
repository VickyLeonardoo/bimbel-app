<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    //

    public function index(Request $request)
    {
        $transactions = Transaction::whereIn('status',['Pending','Payment Receive'])->orderBy('created_at','desc')->paginate(10);
        return view('transaction.index',compact('transactions'));
    }

    public function create()
    {
        
    }

    public function store()
    {

    }

    public function show(Transaction $transaction)
    {
        return view('transaction.show',compact('transaction'));
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function set_payement_receive()
    {
        
    } 

    public function approve(Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            foreach ($transaction->items as $tr) {
                if ($tr->course->course_session->isEmpty()) {
                    throw new \Exception('Course session not found');
                }
            }
            
            // Update the transaction status
            $transaction->update(['status' => 'Payment Receive']);

            // Eager load related data to reduce queries
            $transaction->load('items.children', 'items.course.course_session');

            // Create enrollments and attendances
            foreach ($transaction->items as $tr) {
                // Create enrollment
                $enrollment = Enrollment::create([
                    'transaction_id' => $transaction->id,
                    'course_id' => $tr->course_id,
                    'year_id' => $transaction->year_id,
                    'children_id' => $tr->children_id,
                    'status' => 'Approved',
                    'grade' => $tr->children->grade,
                ]);

                // Create attendances for each session
                foreach ($tr->course->course_session as $session) {
                    Attendance::create([
                        'children_id' => $tr->children_id,
                        'session_course_id' => $session->id,
                        'year_id' => $transaction->year_id,
                        'grade' => $tr->children->grade,
                        'enrollment_id' => $enrollment->id
                    ]);
                }
            }
            
            DB::commit();
            return redirect()->route('transaction.show', $transaction)->with('success', 'Transaction has been Approved');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function reject(Request $request, Transaction $transaction){
        $transaction->update([
            'status' => 'Cancelled',
            'reason' => $request->reason,
        ]);

        return redirect()->route('transaction.show',$transaction)->with('success','Transaction has been rejected');
    }
}
