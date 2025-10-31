<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// 🔹 Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home.page');

// 🔹 Các trang tĩnh
Route::get('/health', function () {
    return view('health');
})->name('health.page');

Route::get('/fitness', function () {
    return view('fitness');
})->name('fitness.page');
Route::get('/nutrition', function () {
    return view('nutrition');
})->name('nutrition.page');   

Route::get('/community', function () {
    return view('community');
})->name('community.page');   

Route::get('/profile', function () {
    return view('profile');
})->name('profile.page');

route::get('/meal-detail', function () {
    return view('meal-detail');
})->name('meal.detail.page');

// 🔹 Đăng nhập / Đăng xuất
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// 🔹 Đăng ký
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.page');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// 🔹 Đăng xuất (nên dùng POST để bảo mật)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');