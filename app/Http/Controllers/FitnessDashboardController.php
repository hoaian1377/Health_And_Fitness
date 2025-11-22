<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\FitnessGoalWorkout;
use App\Models\FitnessGoal;
use App\Models\WorkoutExercise;
use App\Models\MealPlan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FitnessDashboardController extends Controller
{
    public function index() {
        try {
            // Lấy user đang đăng nhập
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login.show')->with('error', 'Vui lòng đăng nhập để xem hồ sơ.');
            }

            // Lấy account từ database
            $account = Account::where('user_id', $user->id)->first();
            
            // Nếu không có account, tạo mới
            if (!$account) {
                $account = Account::create([
                    'user_id' => $user->id,
                    'fullname' => $user->name,
                    'weight' => 0,
                    'height' => 0,
                    'bmi' => 0,
                ]);
            }

            // Lấy fitness goal từ database nếu có
            $fitnessGoal = null;
            $goalWorkouts = collect();
            $exercises = collect();
            
            if (isset($account->fitness_goalID) && $account->fitness_goalID) {
                try {
                    $fitnessGoal = FitnessGoal::find($account->fitness_goalID);
                    
                    if ($fitnessGoal) {
                        // Lấy bài tập liên quan tới fitness_goalID
                        $goalWorkouts = FitnessGoalWorkout::with('workout')
                            ->where('fitness_goalID', $account->fitness_goalID)
                            ->get()
                            ->map(function($fw) {
                                return $fw->workout;
                            })
                            ->filter(); // Loại bỏ null
                        
                        $exercises = $goalWorkouts;
                    }
                } catch (\Exception $e) {
                    \Log::warning('Error loading fitness goal: ' . $e->getMessage());
                }
            }

            // Nếu không có exercises từ goal, lấy tất cả exercises từ database
            if ($exercises->isEmpty()) {
                try {
                    $exercises = WorkoutExercise::all();
                } catch (\Exception $e) {
                    \Log::warning('Error loading exercises: ' . $e->getMessage());
                    $exercises = collect();
                }
            }

            // Tính BMI từ database hoặc tính lại
            $bmi = $account->bmi;
            if (!$bmi && $account->height && $account->weight && $account->height > 0) {
                $height_m = $account->height / 100;
                $bmi = round($account->weight / ($height_m * $height_m), 1);
                // Cập nhật lại vào database
                $account->update(['bmi' => $bmi]);
            }

            // Tính tuổi từ database
            $age = null;
            if ($account->birthday) {
                try {
                    $age = Carbon::parse($account->birthday)->age;
                } catch (\Exception $e) {
                    $age = null;
                }
            }

            // Tính TDEE (Total Daily Energy Expenditure)
            $bmr = 0;
            $tdee = 0;
            if ($account->weight && $account->height && $age) {
                // Công thức Mifflin-St Jeor (nam giới)
                $bmr = 10 * $account->weight + 6.25 * $account->height - 5 * $age + 5;
                
                // Activity multiplier (mặc định moderate activity)
                $activityMultiplier = 1.55; // moderate activity
                $tdee = round($bmr * $activityMultiplier);
            }

            // Lấy mục tiêu từ database hoặc mặc định
            $goal_type = 'weight_loss'; // mặc định
            $goal_weight = $account->weight ?? 60;
            $target_weight = $goal_weight;
            
            if ($fitnessGoal) {
                // Lấy thông tin từ fitness goal nếu có
                $goal_type = $fitnessGoal->goal_type ?? 'weight_loss';
                $target_weight = $fitnessGoal->target_weight ?? $goal_weight;
            }

            // Tính toán calories mục tiêu
            $weight_diff = $account->weight ? ($account->weight - $target_weight) : 0;
            $daily_adjustment = 500; // kcal deficit/surplus mỗi ngày
            $total_cal_to_burn = abs($weight_diff) * 7700;
            $days_needed = $daily_adjustment > 0 ? ceil($total_cal_to_burn / $daily_adjustment) : 0;

            // Tính goal_calories dựa trên mục tiêu
            switch ($goal_type) {
                case 'weight_loss':
                    $goal_calories = max(1200, $tdee - 500); // giảm 500 kcal/ngày, tối thiểu 1200
                    break;
                case 'weight_gain':
                    $goal_calories = $tdee + 500; // tăng 500 kcal/ngày
                    break;
                case 'muscle_gain':
                    $goal_calories = $tdee + 300; // tăng nhẹ để tập cơ
                    break;
                default:
                    $goal_calories = $tdee > 0 ? $tdee : 2000; // mặc định 2000 nếu không tính được
            }

            // Đảm bảo các giá trị không null
            $account->weight = $account->weight ?? 0;
            $account->height = $account->height ?? 0;
            $account->fullname = $account->fullname ?? $user->name;
            $bmi = $bmi ?? 0;
            $age = $age ?? 0;
            $goal_calories = $goal_calories ?? 2000;

            // Lấy meal plan từ database (theo fitness goal hoặc meal đầu tiên)
            $mealPlan = null;
            if ($fitnessGoal) {
                $mealPlan = MealPlan::where('fitness_goalID', $fitnessGoal->fitness_goalID)->first();
            }
            if (!$mealPlan) {
                $mealPlan = MealPlan::first();
            }

            // Lấy thống kê hôm nay
            $todayStat = \App\Models\DailyStat::where('user_id', $user->id)
                ->where('date', Carbon::today()->format('Y-m-d'))
                ->first();

            $caloriesBurnedToday = $todayStat ? $todayStat->calories_burned : 0;
            $progressPercentage = $goal_calories > 0 ? min(100, round(($caloriesBurnedToday / $goal_calories) * 100)) : 0;
            
            // Progress details (có thể lấy từ database sau)
            $cardioProgress = 85; // Mặc định
            $strengthProgress = 75; // Mặc định
            $flexibilityProgress = 65; // Mặc định

            // Tính calories theo tuần (7 ngày gần nhất)
            $weeklyStats = \App\Models\DailyStat::where('user_id', $user->id)
                ->where('date', '>=', Carbon::now()->subDays(6)->format('Y-m-d'))
                ->orderBy('date', 'asc')
                ->get();

            $weeklyCalories = [];
            // Tạo map để dễ tra cứu
            $statsMap = [];
            foreach ($weeklyStats as $stat) {
                $statsMap[$stat->date] = $stat->calories_burned;
            }

            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $dateStr = $date->format('Y-m-d');
                
                $weeklyCalories[] = [
                    'date' => $dateStr,
                    'day' => $date->format('D'),
                    'calories' => $statsMap[$dateStr] ?? 0
                ];
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
                'goal_calories',
                'fitnessGoal',
                'mealPlan',
                'progressPercentage',
                'cardioProgress',
                'strengthProgress',
                'flexibilityProgress',
                'weeklyCalories'
            ));

        } catch (\Exception $e) {
            \Log::error('FitnessDashboard Error: ' . $e->getMessage());
            return redirect()->route('home.page')->with('error', 'Có lỗi xảy ra khi tải hồ sơ: ' . $e->getMessage());
        }
    }
}
