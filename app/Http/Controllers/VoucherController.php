<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function validateVoucher(Request $request)
    {
        $code = $request->input('code');
        $voucher = Voucher::where('code', $code)->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không tồn tại'
            ]);
        }

        if ($voucher->expiry_date && Carbon::now()->gt($voucher->expiry_date)) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết hạn'
            ]);
        }

        if ($voucher->usage_limit && $voucher->used_count >= $voucher->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết lượt sử dụng'
            ]);
        }

        return response()->json([
            'success' => true,
            'discount_type' => $voucher->discount_type,
            'discount_value' => $voucher->discount_value,
            'message' => 'Áp dụng mã giảm giá thành công'
        ]);
    }
}
