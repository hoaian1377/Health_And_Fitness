<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
}
