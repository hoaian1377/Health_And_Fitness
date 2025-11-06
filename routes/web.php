<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Routing\Router;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;
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



// Trang cộng đồng
Route::get('/community', [CommunityController::class, 'index'])->name('community.page');

// Đăng bài
Route::post('/community/post', [CommunityController::class, 'storePost'])->name('community.post')->middleware('auth');

// Bình luận
Route::post('/community/{post}/comment', [CommunityController::class, 'storeComment'])->name('community.comment')->middleware('auth');

// Like / Unlike
Route::post('/community/{post}/like', [CommunityController::class, 'toggleLike'])->name('community.like')->middleware('auth');


Route::get('/profile', function () {
    return view('profile');
})->name('profile.page');

route::get('/meal-detail', function () {
    return view('meal-detail');
})->name('meal.detail.page');

// 🔹 Đăng nhập / Đăng xuất
Route::middleware('guest')->group(function(){
    Route::get('register', [AuthController::class, 'showRegister'])->name('register.show');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::get('login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::get('/workout/{id}', [WorkoutController::class, 'show'])->name('workout.detail');