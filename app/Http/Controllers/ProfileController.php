<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Trang Profile
    public function index()
    {
        return view('profile');
    }

    // Cập nhật Profile
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
            'new_password'              => 'required|min-6|confirmed',
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
