<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreYearRequest;
use App\Http\Requests\UpdateYearRequest;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $years = Year::query();

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'code' dan 'name'
            $years = $years->where(function ($q) use ($query) {
                $q->where('reg_start_date', 'like', "%{$query}%")
                ->orWhere('reg_end_date', 'like', "%{$query}%");
            });
        }

        $years = $years->paginate(10);

        return view('year.index',compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreYearRequest $request)
    {
        $validate = $request->validated();

        if ($validate['reg_start_date'] > $validate['reg_end_date']) {
            return redirect()->back()->withErrors(['reg_start_date' => 'Start date must be before end date'])->withInput();
        }

        if ($validate['reg_end_date'] < now()->toDateString()) {
            return redirect()->back()->withErrors(['reg_end_date' => 'Registration end date cannot less than today date'])->withInput();   
        }

        

        $year = Year::create($validate);

        return redirect()->route('year.index')->with('success','Year successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Year $year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Year $year)
    {
        return view('year.edit',compact('year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateYearRequest $request, Year $year)
    {
        $validate = $request->validated();

        $year->update([
            'name' => $validate['name'],
            'reg_start_date' => $validate['reg_start_date'],
            'reg_end_date' => $validate['reg_end_date']
        ]);

        return redirect()->route('year.index')->with('success','Year successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year)
    {
        $year->delete();
        return redirect()->route('year.index')->with('success','Year successfully deleted.');
    }
}
