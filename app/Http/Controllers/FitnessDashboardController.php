<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\FitnessGoalWorkout;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FitnessDashboardController extends Controller
{
    public function index() {
        // Lấy user hiện tại hoặc demo user đầu tiên
        $user = User::with('account')->first(); // Hoặc Auth::user() nếu đã đăng nhập
        if (!$user || !$user->account) {
            return redirect()->route('home.page')->with('error', 'Tài khoản chưa được tạo.');
        }

        $account = $user->account;

        // Lấy bài tập liên quan tới fitness_goalID
        $goalWorkouts = FitnessGoalWorkout::with('workout')
            ->where('fitness_goalID', $account->fitness_goalID)
            ->get()
            ->map(fn($fw) => $fw->workout);

        // Tính BMI
        $height_m = $account->height / 100;
        $bmi = $height_m > 0 ? round($account->weight / ($height_m * $height_m), 1) : 0;

        // Tính tuổi
        $age = $account->birthday ? Carbon::parse($account->birthday)->age : null;

        // Tính TDEE (giả sử male, moderate activity)
        $bmr = $age ? 10 * $account->weight + 6.25 * $account->height - 5 * $age + 5 : 0;
        $tdee = round($bmr * 1.55);
        // Tính goal_calories dựa trên mục tiêu



        // Giả sử mục tiêu giảm cân
        $goal_type = 'weight_loss'; // Có thể là 'weight_gain','muscle_gain','weight_loss'
        $goal_weight = 60; // ví dụ
        $weight_diff = $account->weight - $goal_weight;
        $daily_adjustment = 550; // kcal deficit mỗi ngày
        $total_cal_to_burn = abs($weight_diff) * 7700;
        $days_needed = $daily_adjustment > 0 ? ceil($total_cal_to_burn / $daily_adjustment) : 0;
        $target_weight = $goal_weight; // gán mục tiêu cân nặng
        $exercises = $goalWorkouts;
        switch ($goal_type) {
            case 'weight_loss':
                $goal_calories = $tdee - 500; // giảm 500 kcal/ngày
                break;
            case 'weight_gain':
                $goal_calories = $tdee + 500; // tăng 500 kcal/ngày
                break;
            case 'muscle_gain':
                $goal_calories = $tdee + 300; // tăng nhẹ để tập cơ
                break;
            default:
                $goal_calories = $tdee;
        }
        return view('profile', compact(
            'user',
            'account',
            'goalWorkouts',
            'bmi',
            'tdee',
            'weight_diff',
            'daily_adjustment',
            'days_needed',
            'goal_type',
            'target_weight',
            'age',
            'exercises',
            'goal_calories'
        ));
    }
}
