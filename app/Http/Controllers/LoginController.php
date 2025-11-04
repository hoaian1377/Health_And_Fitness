<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    //
    public function LoginFrom()
    {
        return view('login');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'passwords'=>'required'
        ]);

        $user=Register::where('username',$request->username)->first();

        if($user && hash::check($request->passwords,$user->passwords))
        {
            Session::put('user',$user);
            return redirect('/')->with('success','Đăng Nhập Thành Công');
        }

        return back()->withErrors([
            'login_error'=>'Tên Đăng Nhập Và Mật Khẩu Không Đúng'
        ]);
            
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/')->with('success','Đăng Xuất Thành Công');
    }
}
