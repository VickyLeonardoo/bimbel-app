<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::paginate(10);
        return view('attending.index',compact('courses'));
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
    public function show(Request $request, $id)
    {
        $classes = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
        ];
        // Ambil tahun aktif
        $current_date = date('');
        $activeYear = Year::firstOrFail();
        $year_id = $request->get('year_id', $activeYear->id);
        $ses_id = $request->get('session_course_id');
        $class = $request->get('class');

        // Ambil kursus dengan eager loading 'sessions' dan 'year'
        $course = Course::with(['course_session' => function($query) use ($year_id) {
            $query->where('year_id', $year_id);
        }, 'course_session.year']) // Eager load 'year' for sessions
                        ->where('id', $id)
                        ->firstOrFail();
                        
        return view('attending.show', [
            'title' => 'Attendee List',
            'sessions' => $course->course_session,
            'years' => Year::all(),
            'course' => $course,
            'selected_year' => $year_id,
            'attendees' => Attendance::where('session_course_id', $request->get('session_course_id'))->where('year_id', $year_id)->where('grade', $class)->where('is_active',true)->with('children')->get(),
            'selected_session' => $ses_id,
            'classes' => $classes,
            'selected_class' => $class,
        ]);
    }

    public function show_report(Request $request, $id){
        $classes = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        
        // Ambil tahun aktif
        $activeYear = Year::firstOrFail();
        $year_id = $request->get('year_id', $activeYear->id);
        $class = $request->get('class');
    
        // Ambil kursus dengan eager loading 'sessions' dan 'year'
        $course = Course::with(['course_session' => function($query) use ($year_id) {
            $query->where('year_id', $year_id);
        }, 'course_session.year'])
        ->where('id', $id)
        ->firstOrFail();
        
        $findChild = Enrollment::where('grade', $class)
            ->where('year_id', $year_id)
            ->where('course_id', $course->id)
            ->with('children')
            ->get();
    
        // Ambil kehadiran dan susun dalam bentuk yang lebih mudah diakses
        $attendances = Attendance::where('year_id', $year_id)
            ->where('grade', $class)
            ->get()
            ->groupBy('children_id')
            ->map(function($group) {
                return $group->keyBy('session_course_id');
            });
    
        return view('attending.report', [
            'sessions' => $course->course_session,
            'years' => Year::all(),
            'course' => $course,
            'selected_year' => $year_id,
            'attendances' => $attendances,
            'classes' => $classes,
            'selected_class' => $class,
            'childs' => $findChild,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    public function update_status(Request $request){
        $ids = $request->input('ids');
        $status = $request->input('status');
        $reason = $request->input('reason', ''); // Default to empty string if not provided

        DB::table('attendances')
            ->whereIn('id', $ids)
            ->update([
                'status' => $status,
                'reason' => $status === 'Leave' ? $reason : null // Only update reason if status is 'permission'
            ]);

        return response()->json(['success' => true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
