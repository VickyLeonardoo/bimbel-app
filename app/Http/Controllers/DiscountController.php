<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index(Request $request)
    {
        $discounts = Discount::query();

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'code' dan 'name'
            $discounts = $discounts->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('code', 'like', "%{$query}%")
                ->orWhere('date_valid', 'like', "%{$query}%")
                ->orWhere('status', 'like', "%{$query}%")
                ->orWhere('type', 'like', "%{$query}%")
                ->orWhere('total', 'like', "%{$query}%");
            });
        }

        $discounts = $discounts->paginate(10);
        return view('discount.index',compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request)
    {
        $validate = $request->validated();

        if ($validate['total'] <= 0) {
            return redirect()->back()->withErrors(['total' => 'Total cannot be less than 0%'])->withInput();
        }
        if ($validate['type'] == 'percent') {
            if ($validate['total'] >= 100) {
                return redirect()->back()->withErrors(['total' => 'Total cannot be more than 100%'])->withInput();
            }elseif($validate['total'] <= 0 ){
                return redirect()->back()->withErrors(['total' => 'Total cannot be less than 0%'])->withInput();
            }
        }

        if ($validate['date_valid'] < now()->toDateString()) {
            return redirect()->back()->withErrors(['date_valid' => 'Valid date cannot be in the past'])->withInput();
        }
        Discount::create([
            'name' => $validate['name'],
            'code' => $validate['code'],
            'total' => $validate['total'],
            'type' => $validate['type'],
            'date_valid' => $validate['date_valid'],
        ]);

        return redirect()->route('discount.index')->with('success','Discount successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        return view('discount.edit',compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $validate = $request->validated();

        if ($validate['total'] <= 0) {
            return redirect()->back()->withErrors(['total' => 'Total cannot be less than 0%'])->withInput();
        }
        if ($validate['type'] == 'percent') {
            if ($validate['total'] >= 100) {
                return redirect()->back()->withErrors(['total' => 'Total cannot be more than 100%'])->withInput();
            }elseif($validate['total'] <= 0 ){
                return redirect()->back()->withErrors(['total' => 'Total cannot be less than 0%'])->withInput();
            }
        }

        if ($validate['date_valid'] < now()->toDateString()) {
            return redirect()->back()->withErrors(['date_valid' => 'Valid date cannot be in the past'])->withInput();
        }

        $discount->update([
            'name' => $validate['name'],
            'code' => $validate['code'],
            'total' => $validate['total'],
            'type' => $validate['type'],
            'date_valid' => $validate['date_valid'],
        ]);
        return redirect()->route('discount.index')->with('success','Discount successfully updated!');

    }

    public function status(Discount $discount){
        if ($discount->status == 0) {
            $discount->update([
                'status' => true
            ]);
        }elseif ($discount->status == 1) {
            $discount->update([
                'status' => false
            ]);
        }
        return redirect()->route('discount.index')->with('success','Discount successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        //
    }
}
