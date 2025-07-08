<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Session;
use App\Models\SessionCourse;
use App\Models\TransactionItem;
use App\Models\Year;
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
        $transaction_item_check = TransactionItem::where('course_id', $course->id)->first();
        if ($transaction_item_check) {
            return redirect()->back()->with('error','Course has transaction item, You cannot delete the Course');
        }

        $course->delete();
        return redirect()->back()->with('success','Course deleted successfully');
    }

    public function session(Course $course){
        $years = Year::orderBy('id','desc')->get();
        $sessions = $course->course_session()->get();
        return view('course.session',compact('course','years','sessions'));
    }

    public function session_store(Request $request, Course $course){
        //Search for exists session
        $session_check = SessionCourse::where('year_id', $request->year_id)->where('course_id', $course->id)->first();
        if ($session_check) {
            return redirect()->back()->with('error','Session already exists');
        }
        $session_number = $course->session;

        for ($i=0; $i < $session_number; $i++) { 
            $course->course_session()->create([
                'name' => 'Session ' . ($i + 1),
                'course_id' => $course->id,
                'year_id' => $request->year_id
            ]);
        }

        return redirect()->back()->with('success','Session generated successfully');
    }
}
