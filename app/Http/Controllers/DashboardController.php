<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(){
        $student_count = Enrollment::where('status', 'Approved')
            ->whereYear('created_at', now()->year)
            ->distinct('children_id')
            ->count();
    
        $student_count_last_year = Enrollment::where('status', 'Approved')
            ->whereYear('created_at', now()->year - 1)
            ->distinct('children_id')
            ->count();
    
        if ($student_count_last_year > 0) {
            $student_change_percentage = (($student_count - $student_count_last_year) / $student_count_last_year) * 100;
        } else {
            $student_change_percentage = $student_count > 0 ? 100 : 0;
        }
    
        // kode lainnya tetap...
        $application_count = Transaction::where('status','Pending')->count();
        $revenue = Transaction::where('status', 'Payment Receive')
                ->whereYear('updated_at', now()->year)
                ->sum('amount');
    
        $revenue_before = Transaction::where('status', 'Payment Receive')
                ->whereYear('updated_at', now()->year - 1)
                ->sum('amount');
    
        if ($revenue_before > 0) {
            $revenue_change = (($revenue - $revenue_before) / $revenue_before) * 100;
        } else {
            $revenue_change = $revenue > 0 ? 100 : 0;
        }
    
        $instructor_count = Instructor::count();
        $recent_transaction = Transaction::where('status','Pending')
            ->where('updated_at' , '>=', now()->subDay())
            ->latest()
            ->take(5)
            ->get();
    
        return view('dashboard', [
            'student_count' => $student_count,
            'student_change_percentage' => $student_change_percentage,
            'application_count' => $application_count,
            'revenue' => $revenue,
            'instructor_count' => $instructor_count,
            'recent_transactions' => $recent_transaction,
            'revenue_change' => $revenue_change,
        ]);
    }
    
}
