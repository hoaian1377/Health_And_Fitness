<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Routing\Router;
use App\Http\Controllers\LoginController;

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
Route::get('/login', [LoginController::class, 'LoginFrom'])->name('login.LoginFrom');
Route::post('/login', [LoginController::class, 'login'])->name('login.login');

// 🔹 Đăng ký
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'register'])->name('register.register');

//logout
Route::post('logout',[LoginController::class,'logout'])->name('logout');

Route::get('/workout/{id}', [WorkoutController::class, 'show'])->name('workout.detail');