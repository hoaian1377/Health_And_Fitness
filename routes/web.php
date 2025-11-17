<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\WorkoutExerciseController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\ProfileController;

// =================== TRANG CHỦ ===================
Route::get('/', [HomeController::class, 'index'])->name('home.page');


// =================== TRANG TĨNH ===================
Route::get('/health', function () {
    return view('health');
})->name('health.page');


// =================== CỘNG ĐỒNG ===================
Route::get('/community', [CommunityController::class, 'index'])->name('community.page');

// Đăng bài
Route::post('/community/post', [CommunityController::class, 'storePost'])
    ->name('community.post')
    ->middleware('auth');

// Bình luận
Route::post('/community/{post}/comment', [CommunityController::class, 'storeComment'])
    ->name('community.comment')
    ->middleware('auth');

// Like / Unlike
Route::post('/community/{post}/like', [CommunityController::class, 'toggleLike'])
    ->name('community.like')
    ->middleware('auth');


// =================== TRANG CÁ NHÂN ===================
// Profile
Route::middleware('auth')->get('/profile', [ProfileController::class, 'index'])->name('profile.page');
Route::middleware('auth')->put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Profile API (JSON endpoints)
Route::middleware('auth')->group(function () {
    Route::post('/api/profile/update', [ProfileController::class, 'updateApi']);
    Route::post('/api/profile/avatar', [ProfileController::class, 'updateAvatar']);
    Route::delete('/api/profile', [ProfileController::class, 'deleteAccount']);
});


// =================== ĐỔI MẬT KHẨU (NEW) ===================
Route::middleware('auth')->group(function () {
    Route::get('/change-password', [ProfileController::class, 'changePassword'])
        ->name('password.change');

    Route::post('/change-password', [ProfileController::class, 'updatePassword'])
        ->name('password.update');
});


// =================== AUTH ===================
Route::middleware('guest')->group(function(){
    Route::get('register', [AuthController::class, 'showRegister'])->name('register.show');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::get('login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// =================== WORKOUTS ===================
Route::get('/workouts', [WorkoutExerciseController::class, 'index'])->name('workouts.page');
Route::get('/workouts/{id}', [WorkoutExerciseController::class, 'show'])->name('workouts-detail');


// =================== DINH DƯỠNG ===================
Route::get('/nutrition', [MealPlanController::class, 'index'])->name('nutrition.page');
Route::get('/nutrition/{id}', [MealPlanController::class, 'show'])->name('meal-detail');
