<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account; // ✅ Thêm dòng này
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegister() {
        return view('register');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'password' => ['required','confirmed', Password::min(8)],
        ]);

        // ✅ Tạo user
        $user = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // ✅ Tạo account tương ứng cho user
        Account::create([
            'fullname' => $user->name,
            'user_id'  => $user->id,
        ]);

        // ✅ Tự động đăng nhập sau khi đăng ký
        Auth::login($user);

        // ✅ Chuyển hướng về trang chủ hoặc community
        return redirect()->route('home.page')->with('success', 'Đăng ký thành công!');
    }

    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // chống session fixation
            return redirect()->intended(route('home.page'));
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.page');
    }
}
