<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromoController extends Controller
{
    public function checkPromo(Request $request)
    {
        $promo = Discount::where('code', $request->promo_code)
                        ->where('status', true)
                        ->whereDate('date_valid', '>=', Carbon::today())
                        ->first();

        if (!$promo) {
            return response()->json(['success' => false, 'message' => 'Kode promo tidak valid atau sudah tidak aktif.'], 400);
        }

        // Cek tipe diskon
        if ($promo->type === 'percent') {
            $discountText = "{$promo->total}%";
        } else {
            $discountText = "Rp " . number_format($promo->total, 0, ',', '.');
        }

        return response()->json([
            'success' => true,
            'discount' => $discountText,
            'message' => 'Kode promo berhasil diterapkan!'
        ]);
    }
}
