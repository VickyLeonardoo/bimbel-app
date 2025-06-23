<?php

namespace App\Http\Controllers\Front;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    //
    public function index()
    {
        $testimonials = Testimonial::where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Calculate statistics
        $averageRating = Testimonial::where('is_public', true)->avg('rating') ?? 0;
        $totalTestimonials = Testimonial::where('is_public', true)->count();
        $fiveStarCount = Testimonial::where('is_public', true)->where('rating', 5)->count();
        $fiveStarPercentage = $totalTestimonials > 0 ? round(($fiveStarCount / $totalTestimonials) * 100) : 0;

        return view('testimoni', compact(
            'testimonials', 
            'averageRating', 
            'fiveStarPercentage'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $testimonial = Testimonial::create([
                'name' => $request->name,
                'review' => $request->review,
                'rating' => $request->rating,
                'user_id' => auth()->id(), // Jika ingin menyimpan user yang login
                'is_public' => false, // Default belum disetujui
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil dikirim!',
                'data' => $testimonial
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan testimoni'
            ], 500);
        }
    }
}
