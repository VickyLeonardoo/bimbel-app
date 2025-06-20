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
        $student_count = Enrollment::where('status', 'Approved')->distinct('children_id')->count();
        $application_count = Transaction::where('status','Pending')->count();
        $revenue = Transaction::where('status', 'Payment Receive')
                ->whereYear('updated_at', now()->year)
                ->sum('amount');

        $revenue_before = Transaction::where('status', 'Payment Receive')
                ->whereYear('updated_at', now()->year - 1)
                ->sum('amount');

        // Hitung persen perubahan
        if ($revenue_before > 0) {
            $revenue_change = (($revenue - $revenue_before) / $revenue_before) * 100;
        } else {
            $revenue_change = $revenue > 0 ? 100 : 0; // Jika sebelumnya 0 dan sekarang ada, anggap naik 100%
        }

        $instructor_count = Instructor::count();

        $recent_transaction = Transaction::where('status','Pending')->where('updated_at' , '>=', now()->subDay())->latest()->take(5)->get();


        return view('dashboard', [
            'student_count' => $student_count,
            'application_count' => $application_count,
            'revenue' => $revenue,
            'instructor_count' => $instructor_count,
            'recent_transactions' => $recent_transaction,
            'revenue_change' => $revenue_change,
        ]);

        return view('dashboard');
    }
}
