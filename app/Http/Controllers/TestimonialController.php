<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all'); // all, public, hidden
        
        $query = Testimonial::orderBy('created_at', 'desc');
        
        // Apply filter
        switch ($filter) {
            case 'public':
                $query->where('is_public', true);
                break;
            case 'hidden':
                $query->where('is_public', false);
                break;
            case 'all':
            default:
                // No additional filter needed
                break;
        }
        
        $testimonials = $query->paginate(12);
        
        // Calculate statistics for all testimonials (not filtered)
        $allTestimonials = Testimonial::all();
        $publicTestimonials = $allTestimonials->where('is_public', true);
        $hiddenTestimonials = $allTestimonials->where('is_public', false);
        
        $averageRating = $publicTestimonials->avg('rating') ?? 0;
        $publicCount = $publicTestimonials->count();
        $hiddenCount = $hiddenTestimonials->count();
        $totalCount = $allTestimonials->count();
        
        $fiveStarCount = $publicTestimonials->where('rating', 5)->count();
        $fiveStarPercentage = $publicCount > 0 ? round(($fiveStarCount / $publicCount) * 100) : 0;
        
        return view('testimoni.index', compact(
            'testimonials',
            'averageRating',
            'fiveStarPercentage',
            'publicCount',
            'hiddenCount',
            'totalCount',
            'filter'
        ));
    }

    /**
     * Toggle visibility of a testimonial
     */
    public function toggleVisibility(Request $request, $id): JsonResponse
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            
            $request->validate([
                'is_public' => 'required|boolean'
            ]);
            
            $testimonial->is_public = $request->is_public;
            $testimonial->save();
            
            $status = $testimonial->is_public ? 'ditampilkan' : 'disembunyikan';
            
            return response()->json([
                'success' => true,
                'message' => "Testimoni berhasil {$status}",
                'data' => [
                    'id' => $testimonial->id,
                    'is_public' => $testimonial->is_public
                ]
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Testimoni tidak ditemukan'
            ], 404);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui testimoni'
            ], 500);
        }
    }

    /**
     * Bulk action for testimonials
     */
    public function bulkAction(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'action' => 'required|in:show,hide,delete',
                'testimonial_ids' => 'required|array|min:1',
                'testimonial_ids.*' => 'integer|exists:testimonials,id'
            ]);

            $testimonialIds = $request->testimonial_ids;
            $action = $request->action;
            $affectedCount = 0;

            switch ($action) {
                case 'show':
                    $affectedCount = Testimonial::whereIn('id', $testimonialIds)
                        ->update(['is_public' => true]);
                    $message = "{$affectedCount} testimoni berhasil ditampilkan";
                    break;
                    
                case 'hide':
                    $affectedCount = Testimonial::whereIn('id', $testimonialIds)
                        ->update(['is_public' => false]);
                    $message = "{$affectedCount} testimoni berhasil disembunyikan";
                    break;
                    
                case 'delete':
                    $affectedCount = Testimonial::whereIn('id', $testimonialIds)->delete();
                    $message = "{$affectedCount} testimoni berhasil dihapus";
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'affected_count' => $affectedCount
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses aksi massal'
            ], 500);
        }
    }

    /**
     * Show testimonial details
     */
    public function show($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $testimonial
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Testimoni tidak ditemukan'
            ], 404);
        }
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

    /**
     * Delete testimonial
     */
    public function destroy($id): JsonResponse
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil dihapus'
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Testimoni tidak ditemukan'
            ], 404);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus testimoni'
            ], 500);
        }
    }

    /**
     * Get testimonials statistics
     */
    public function getStats(): JsonResponse
    {
        try {
            $totalTestimonials = Testimonial::count();
            $publicTestimonials = Testimonial::where('is_public', true)->count();
            $hiddenTestimonials = Testimonial::where('is_public', false)->count();
            
            $averageRating = Testimonial::where('is_public', true)->avg('rating') ?? 0;
            $fiveStarCount = Testimonial::where('is_public', true)->where('rating', 5)->count();
            $fiveStarPercentage = $publicTestimonials > 0 ? round(($fiveStarCount / $publicTestimonials) * 100) : 0;
            
            return response()->json([
                'success' => true,
                'data' => [
                    'total' => $totalTestimonials,
                    'public' => $publicTestimonials,
                    'hidden' => $hiddenTestimonials,
                    'average_rating' => round($averageRating, 1),
                    'five_star_percentage' => $fiveStarPercentage
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil statistik'
            ], 500);
        }
    }
}
