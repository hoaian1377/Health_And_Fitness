<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Trang Profile
    public function index()
    {
        return view('profile');
    }

    // API: Cập nhật Profile dữ liệu JSON
    public function updateApi(Request $request)
    {
        $user = Auth::user();
        $type = $request->input('type');
        $data = $request->input('data', []);

        try {
            switch ($type) {
                case 'personal':
                    $validated = $request->validate([
                        'data.fullName' => 'nullable|string|max:255',
                        'data.phone' => 'nullable|string|max:20',
                        'data.dob' => 'nullable|date',
                        'data.gender' => 'nullable|in:male,female,other',
                        'data.address' => 'nullable|string|max:255',
                    ]);

                    $user->update([
                        'name' => $data['fullName'] ?? $user->name,
                        'phone' => $data['phone'] ?? $user->phone,
                        'dob' => $data['dob'] ?? $user->dob,
                        'gender' => $data['gender'] ?? $user->gender,
                        'address' => $data['address'] ?? $user->address,
                    ]);
                    break;

                case 'health':
                    $validated = $request->validate([
                        'data.height' => 'nullable|numeric|min:50|max:250',
                        'data.weight' => 'nullable|numeric|min:10|max:500',
                        'data.blood_type' => 'nullable|string|max:5',
                        'data.activity_level' => 'nullable|in:sedentary,light,moderate,active,very_active',
                    ]);

                    $height = $data['height'] ?? $user->height;
                    $weight = $data['weight'] ?? $user->weight;

                    // Tính BMI
                    $bmi = null;
                    if ($height && $weight) {
                        $heightInMeters = $height / 100;
                        $bmi = round($weight / ($heightInMeters ** 2), 1);
                    }

                    $user->update([
                        'height' => $height,
                        'weight' => $weight,
                        'bmi' => $bmi,
                        'blood_type' => $data['blood_type'] ?? $user->blood_type,
                        'activity_level' => $data['activity_level'] ?? $user->activity_level,
                    ]);
                    break;

                case 'preferences':
                    // Lưu preferences vào session
                    session([
                        'preferences.notifications' => $data['notifications'] ?? true,
                        'preferences.language' => $data['language'] ?? 'vi',
                        'preferences.theme' => $data['theme'] ?? 'light',
                    ]);
                    break;

                default:
                    return response()->json(['success' => false, 'message' => 'Invalid type'], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // API: Cập nhật Avatar
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $user = Auth::user();

            // Xóa avatar cũ
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Lưu avatar mới
            $path = $request->file('avatar')->store('avatars', 'public');

            $user->update([
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

    // API: Xóa tài khoản
    public function deleteAccount(Request $request)
    {
        try {
            $user = Auth::user();

            // Xóa avatar nếu có
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Xóa tất cả dữ liệu liên quan
            // $user->posts()->delete();
            // $user->comments()->delete();
            // $user->goals()->delete();

            // Xóa user
            $user->delete();

            Auth::logout();

            return response()->json([
                'success' => true,
                'message' => 'Tài khoản đã được xóa!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // Cập nhật Profile (form cũ)
    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();

        $user->name  = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

    // UI đổi mật khẩu
    public function changePassword()
    {
        return view('auth.change_password');
    }

    // Xử lý đổi mật khẩu
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'          => 'required',
            'new_password'              => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Cập nhật
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}

