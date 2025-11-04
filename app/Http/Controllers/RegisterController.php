<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username'=>'required|unique:register',
            'passwords'=>'required|min:8',
            'email'=>'required|unique:register'
        ]);

        Register::create([
            'username'=>$request->username,
            'passwords'=>bcrypt($request->passwords),
            'email'=>$request->email
        ]);

        return redirect('/login')->with('success','Đăng Ký Thành Công');
    }
}
