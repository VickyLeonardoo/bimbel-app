<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Enrollment::query()
            ->with(['transaction', 'children', 'course']); // Eager load relationships

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            
            $query->where(function($q) use ($searchTerm) {
                // Search in enrollments table
                $q->where('id', 'LIKE', "%{$searchTerm}%")
                
                // Search in transactions relationship
                ->orWhereHas('transaction', function($query) use ($searchTerm) {
                    $query->where('transaction_no', 'LIKE', "%{$searchTerm}%");
                })
                
                // Search in children relationship
                ->orWhereHas('children', function($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', "%{$searchTerm}%");
                })
                
                // Search in courses relationship
                ->orWhereHas('course', function($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', "%{$searchTerm}%");
                });
            });
        }

        // Add sorting (optional)
        $query->orderBy('created_at', 'desc');

        // Paginate the results
        $enrollments = $query->paginate(10)
            ->withQueryString(); // Preserve search parameters in pagination links

        return view('enrollment.index', compact('enrollments'));
    }
    public function update_enrollment(Enrollment $enrollment) {
        // Ubah status enrollment
        $enrollment->status = 'Cancelled';
        $enrollment->save();
    
        // Nonaktifkan semua attendance
        $enrollment->attendance()->update(['is_active' => false]);
    
        return redirect()->back()->with('success', 'Enrollment Cancelled');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {

        if ($enrollment->status == 'Approved'){
            // Ubah status enrollment
            $enrollment->status = 'Cancelled';
            $enrollment->save();
        
            // Nonaktifkan semua attendance
            $enrollment->attendance()->update(['is_active' => false]);
        }
        else {
            // Ubah status enrollment
         $enrollment->status = 'Approved';
         $enrollment->save();
     
         // Nonaktifkan semua attendance
         $enrollment->attendance()->update(['is_active' => true]);
         }
     
         return redirect()->back()->with('success', 'Enrollment Cancelled');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        //
    }
}
