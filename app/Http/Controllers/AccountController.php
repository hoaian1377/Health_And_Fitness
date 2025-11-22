<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function dashboard()
    {
    $user = Auth::user(); // lấy user hiện tại
    $account = Account::where('user_id', $user->id)->first(); // lấy thông tin account của user

    // Tính tuổi
    $age = Carbon::parse($account->birthday)->age;

    return view('dashboard', [
        'account' => $account,
        'age' => $age
    ]);
    }

    // Cập nhật thông tin account
    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Người dùng chưa đăng nhập'
                ], 401);
            }
            
            // Tìm account theo user_id
            $account = Account::where('user_id', $user->id)->first();
            
            // Nếu không tìm thấy, tạo mới account
            if (!$account) {
                $account = Account::create([
                    'user_id' => $user->id,
                    'fullname' => $user->name ?? 'Người dùng',
                    'weight' => 0,
                    'height' => 0,
                    'bmi' => 0,
                ]);
            }

            $request->validate([
                'fullname' => 'nullable|string|max:255',
                'weight' => 'nullable|numeric|min:10|max:500',
                'height' => 'nullable|numeric|min:50|max:250',
                'birthday' => 'nullable|date',
            ]);

            $updateData = [];
            
            if ($request->has('fullname') && $request->fullname) {
                $updateData['fullname'] = $request->fullname;
            }
            
            if ($request->has('weight') && $request->weight) {
                $updateData['weight'] = floatval($request->weight);
            }
            
            if ($request->has('height') && $request->height) {
                $updateData['height'] = floatval($request->height);
            }
            
            if ($request->has('birthday') && $request->birthday) {
                $updateData['birthday'] = $request->birthday;
            }

            // Tính lại BMI nếu có weight và height
            $finalWeight = $updateData['weight'] ?? $account->weight;
            $finalHeight = $updateData['height'] ?? $account->height;
            
            if ($finalWeight && $finalHeight && $finalHeight > 0) {
                $height_m = $finalHeight / 100;
                $updateData['bmi'] = round($finalWeight / ($height_m * $height_m), 1);
            }

            if (!empty($updateData)) {
                $account->update($updateData);
                $account->refresh(); // Refresh để lấy dữ liệu mới nhất
            }

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công!',
                'data' => $account
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Account update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Cập nhật avatar
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        try {
            $user = Auth::user();
            $account = Account::where('user_id', $user->id)->first();

            if (!$account) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy tài khoản'
                ], 404);
            }

            // Xóa avatar cũ nếu có
            if ($account->avatar && Storage::disk('public')->exists($account->avatar)) {
                Storage::disk('public')->delete($account->avatar);
            }

            // Lưu avatar mới
            $path = $request->file('avatar')->store('avatars', 'public');

            $account->update([
                'avatar' => $path
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật avatar thành công!',
                'avatar_url' => Storage::url($path)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
    public function updatePlan(Request $request)
    {
        $request->validate([
            'plan' => 'required|string|max:255'
        ]);

        try {
            $user = Auth::user();
            $account = Account::where('user_id', $user->id)->first();

            if (!$account) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy tài khoản'
                ], 404);
            }

            $account->update([
                'plan' => $request->plan
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật gói thành công!',
                'plan' => $account->plan
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
