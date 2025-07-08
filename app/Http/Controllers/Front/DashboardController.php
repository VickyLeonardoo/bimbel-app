<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Testimonial;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function home(){
        $visi_misi = VisiMisi::all();
        $instructors = Instructor::with('educations')->limit(6)->get();
        $testimonials = Testimonial::where('is_public', 1)
                                  ->orderBy('id', 'desc')
                                  ->limit(6) // Ambil 6 testimoni untuk ditampilkan dalam carousel
                                  ->get();
        
        return view('welcome', compact('visi_misi', 'instructors', 'testimonials'));
    }

    public function index(){
        return view('frontend.dashboard');
    }
} 
