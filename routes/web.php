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
use App\Http\Controllers\FitnessDashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChatbotController;

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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.page');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Đổi mật khẩu
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('password.change');
    Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])->name('password.update');
    
    // Redirect for backward compatibility
    Route::get('/change-password', function () {
        return redirect()->route('password.change');
    });

    // Workout API
    Route::get('/api/workout/today', [ProfileController::class, 'getTodayWorkouts']);
    Route::post('/api/workout/add', [ProfileController::class, 'addWorkoutLog']);
    Route::delete('/api/workout/reset', [ProfileController::class, 'resetDailyWorkouts']);
    Route::delete('/api/workout/{id}', [ProfileController::class, 'deleteWorkoutLog']);

    // Meal API
    Route::post('/api/meal/add', [ProfileController::class, 'addMealLog']);

    // Payment API
    Route::post('/api/account/plan', [ProfileController::class, 'updatePlan']);
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



use App\Http\Controllers\AdminController;

// ... existing imports ...

// =================== ADMIN ===================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Exercises
    Route::get('/exercises', [AdminController::class, 'exercises'])->name('exercises');
    Route::post('/exercises', [AdminController::class, 'storeExercise'])->name('exercises.store');
    Route::get('/exercises/{id}/edit', [AdminController::class, 'editExercise'])->name('exercises.edit');
    Route::put('/exercises/{id}', [AdminController::class, 'updateExercise'])->name('exercises.update');
    Route::delete('/exercises/{id}', [AdminController::class, 'destroyExercise'])->name('exercises.destroy');

    // Nutrition
    Route::get('/nutrition', [AdminController::class, 'nutrition'])->name('nutrition');
    Route::post('/nutrition', [AdminController::class, 'storeMeal'])->name('nutrition.store');
    Route::get('/nutrition/{id}/edit', [AdminController::class, 'editMeal'])->name('nutrition.edit');
    Route::put('/nutrition/{id}', [AdminController::class, 'updateMeal'])->name('nutrition.update');
    Route::delete('/nutrition/{id}', [AdminController::class, 'destroyMeal'])->name('nutrition.destroy');

    // Plans
    Route::get('/plans', [AdminController::class, 'plans'])->name('plans');
    Route::post('/plans', [AdminController::class, 'storePlan'])->name('plans.store');
    Route::get('/plans/{id}/edit', [AdminController::class, 'editPlan'])->name('plans.edit');
    Route::put('/plans/{id}', [AdminController::class, 'updatePlan'])->name('plans.update');
    Route::delete('/plans/{id}', [AdminController::class, 'destroyPlan'])->name('plans.destroy');
});


// =================== CHATBOT ===================
Route::get('/chatbot', function () {
    return view('chatbot');
})->name('chatbot.page');

Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');
