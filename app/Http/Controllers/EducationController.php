<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationRequest;
use App\Models\Education;
use App\Models\Instructor;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Instructor $instructor)
    {
        return view('instructor.education', compact('instructor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEducationRequest $request, Instructor $instructor)
    {
        $validate = $request->validated();

        $instructor->educations()->create([
            'degree' => $validate['degree'],
            'major' => $validate['major'],
            'university' => $validate['university'],
        ]);

        return redirect()->route('instructor.show',$instructor)->with('success','Education added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Education $education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->back()->with('success','Education deleted successfully.');
    }
}
