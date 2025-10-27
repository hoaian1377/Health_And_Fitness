<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // thêm để xử lý đăng ký
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 🔹 Trang đăng nhập
    public function showLogin()
    {
        return view('login');
    }

    // 🔹 Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Lưu session
            $request->session()->regenerate();
            return redirect()->route('home.page')->with('success', 'Đăng nhập thành công!');
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng!');
    }

    // 🔹 Trang đăng ký
    public function showRegister()
    {
        return view('register');
    }

    // 🔹 Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.page')->with('success', 'Đăng ký thành công! Mời bạn đăng nhập.');
    }

    // 🔹 Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.page')->with('success', 'Đã đăng xuất!');
    }
}