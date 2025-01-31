<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::query();

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'code' dan 'name'
            $courses = $courses->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('price', 'like', "%{$query}%");
            });
        }

        $courses = $courses->paginate(10);

        return view('course.index',compact('courses'));
    }
    // {
    //     $courses = Course::paginate(10);
    //     return view('course.index',compact('courses'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $courses = $request->validated();
        Course::create($courses);
        return redirect()->Route('courses.index')->with('success','Course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('course.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();
        $course->update($data);
        return redirect()->Route('courses.index')->with('success','Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success','Course deleted successfully');
    }
}
