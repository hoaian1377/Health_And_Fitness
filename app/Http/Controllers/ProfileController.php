<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Models\WorkoutLog;
use App\Models\WorkoutExercise;
use App\Models\MealPlan;
use Carbon\Carbon;

class ProfileController extends Controller
{
    // Trang Profile
    public function index()
    {
        $user = Auth::user();
        
        // Lấy thông tin account từ user
        $account = $user->account;

        // Nếu chưa có account (trường hợp cũ), tạo mới
        if (!$account) {
            $account = Account::create([
                'user_id' => $user->id,
                'fullname' => $user->name,
                // Các trường khác để null hoặc default
            ]);
            // Reload user relation
            $user->load('account');
        }
        
        // Tính tuổi
        $age = $account->birthday ? \Carbon\Carbon::parse($account->birthday)->age : 0;
        
        // 1. Weekly Stats
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $today = Carbon::today();
        
        $weeklyLogs = collect([]);
        $todayLogs = collect([]);

        // Try to get DB logs
        try {
            if (Schema::hasTable('workout_logs')) {
                $weeklyLogs = WorkoutLog::where('user_id', $user->id)
                    ->whereBetween('date', [$startOfWeek, $endOfWeek])
                    ->get();

                $todayLogs = WorkoutLog::where('user_id', $user->id)
                    ->whereDate('date', $today)
                    ->get();
            }
        } catch (\Exception $e) {
            // Ignore DB errors
        }

        // Merge with Session logs
        $sessionLogs = collect(session('workout_logs', []));
        
        // Filter session logs for this week
        $sessionWeeklyLogs = $sessionLogs->filter(function($log) use ($startOfWeek, $endOfWeek) {
            $logDate = Carbon::parse($log['date']);
            return $logDate->between($startOfWeek, $endOfWeek);
        });
        
        // Filter session logs for today
        $sessionTodayLogs = $sessionLogs->filter(function($log) use ($today) {
            return Carbon::parse($log['date'])->isSameDay($today);
        });

        // Merge DB and Session logs
        $weeklyLogs = $weeklyLogs->concat($sessionWeeklyLogs);
        $todayLogs = $todayLogs->concat($sessionTodayLogs);

        $weeklyCalories = [];
        // Initialize with 0 for all 7 days
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dayLogs = $weeklyLogs->filter(function ($log) use ($date) {
                return Carbon::parse($log['date'] ?? $log->date ?? now())->isSameDay($date);
            });
            $weeklyCalories[] = [
                'date' => $date->format('Y-m-d'),
                'calories' => $dayLogs->sum(function($log) {
                    return $log['calories'] ?? $log->calories ?? 0;
                })
            ];
        }

        // 2. Progress Card (Today)
        $caloriesBurnedToday = $todayLogs->sum(function($log) {
            return $log['calories'] ?? $log->calories ?? 0;
        });
        $goal_calories = 2000; // Fixed for now, or fetch from goal if available
        $progressPercentage = $goal_calories > 0 ? min(100, round(($caloriesBurnedToday / $goal_calories) * 100)) : 0;

        // 3. Breakdown (Cardio, Strength, Flexibility)
        $cardio = 0;
        $strength = 0;
        $flexibility = 0;
        $totalExercises = $todayLogs->count();

        if ($totalExercises > 0) {
            foreach ($todayLogs as $log) {
                // Get exercise name from array or object
                $exerciseName = $log['exercise_name'] ?? $log->exercise_name ?? '';
                
                // Find exercise details to get muscle group/type
                $exercise = WorkoutExercise::where('name_workout', $exerciseName)->first();
                $type = 'strength'; // Default
                
                if ($exercise) {
                    $group = strtolower($exercise->muscle_group);
                    if (str_contains($group, 'cardio') || str_contains($group, 'tim mạch')) {
                        $type = 'cardio';
                    } elseif (str_contains($group, 'yoga') || str_contains($group, 'giãn cơ') || str_contains($group, 'flexibility')) {
                        $type = 'flexibility';
                    }
                }
                
                if ($type == 'cardio') $cardio++;
                elseif ($type == 'flexibility') $flexibility++;
                else $strength++;
            }
            
            $cardioProgress = round(($cardio / $totalExercises) * 100);
            $strengthProgress = round(($strength / $totalExercises) * 100);
            $flexibilityProgress = round(($flexibility / $totalExercises) * 100);
        } else {
            $cardioProgress = 0;
            $strengthProgress = 0;
            $flexibilityProgress = 0;
        }
        
        
        $exercises = WorkoutExercise::all(); // Fetch actual exercises
        
        // Fetch a random meal from database
        $mealPlan = null;
        try {
            if (Schema::hasTable('meal_plan')) {
                $mealPlan = MealPlan::inRandomOrder()->first();
            }
        } catch (\Exception $e) {
            // Ignore DB errors, will show default meal
        }
        
        // Get user plan from Session
        $userPlan = session('user_plan', null);

        return view('profile', compact(
            'account', 
            'age', 
            'progressPercentage',
            'cardioProgress',
            'strengthProgress',
            'flexibilityProgress',
            'goal_calories',
            'caloriesBurnedToday',
            'weeklyCalories',
            'exercises',
            'mealPlan',
            'userPlan'
        ));
    }

    // API: Cập nhật Profile (JSON)
    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            $account = $user->account;

            if (!$account) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy hồ sơ người dùng.'
                ], 404);
            }
            
            $validated = $request->validate([
                'fullname' => 'required|string|max:255',
                'weight' => 'required|numeric|min:10|max:500',
                'height' => 'required|numeric|min:50|max:250',
                'birthday' => 'required|date',
            ]);

            // Update account fields
            $account->fullname = $validated['fullname']; 
            $account->weight = $validated['weight'];
            $account->height = $validated['height'];
            $account->birthday = $validated['birthday'];
            
            // Recalculate BMI
            if ($account->height && $account->weight) {
                $heightInMeters = $account->height / 100;
                $account->bmi = round($account->weight / ($heightInMeters ** 2), 1);
            }

            $account->save();

            // Update user's name for login (sync with fullname)
            $user->name = $validated['fullname'];
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật hồ sơ thành công!',
                'user' => $account // Trả về account updated
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 422);
        }
    }

    // API: Cập nhật Avatar
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $user = Auth::user();
            $account = $user->account;

            if (!$account) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy hồ sơ người dùng.'
                ], 404);
            }

            // Xóa avatar cũ
            if ($account->avatar && Storage::disk('public')->exists($account->avatar)) {
                Storage::disk('public')->delete($account->avatar);
            }

            // Lưu avatar mới
            $path = $request->file('avatar')->store('avatars', 'public');

            $account->avatar = $path;
            $account->save();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật avatar thành công!',
                'avatar_url' => Storage::url($path)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // API: Xóa tài khoản
    public function destroy(Request $request)
    {
        try {
            $user = Auth::user();
            $account = $user->account;

            // Xóa avatar nếu có
            if ($account && $account->avatar && Storage::disk('public')->exists($account->avatar)) {
                Storage::disk('public')->delete($account->avatar);
            }

            // Xóa user (sẽ cascade xóa account nếu đã config foreign key delete cascade)
            // Nếu không, xóa account thủ công:
            // if ($account) $account->delete();
            
            $user->delete();

            Auth::logout();

            return response()->json([
                'success' => true,
                'message' => 'Tài khoản đã được xóa!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // UI đổi mật khẩu
    public function changePassword()
    {
        return view('change-password');
    }

    // Xử lý đổi mật khẩu (JSON API)
    public function updatePassword(Request $request)
    {
        try {
            $validated = $request->validate([
                'old_password' => 'required|string',
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'required|string|same:new_password',
            ]);

            $user = Auth::user();

            // Kiểm tra mật khẩu cũ
            if (!Hash::check($validated['old_password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mật khẩu cũ không đúng',
                    'field' => 'old-password'
                ], 422);
            }

            // Kiểm tra mật khẩu mới không được trùng mật khẩu cũ
            if (Hash::check($validated['new_password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mật khẩu mới phải khác mật khẩu cũ',
                    'field' => 'new-password'
                ], 422);
            }

            // Cập nhật mật khẩu mới vào database
            $user->password = Hash::make($validated['new_password']);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Đổi mật khẩu thành công!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng kiểm tra lại thông tin',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // =================== WORKOUT LOGIC ===================

    public function getTodayWorkouts()
    {
        $user = Auth::user();
        $today = Carbon::today();
        
        $dbLogs = collect([]);
        try {
            if (Schema::hasTable('workout_logs')) {
                 $dbLogs = WorkoutLog::where('user_id', $user->id)
                    ->whereDate('date', $today)
                    ->get();
            }
        } catch (\Exception $e) {
            // Ignore DB errors
        }

        // Get session logs
        $sessionLogs = collect(session('workout_logs', []));
        // Filter by date
        $sessionLogs = $sessionLogs->filter(function($log) use ($today) {
            return Carbon::parse($log['date'])->isSameDay($today);
        });

        $allLogs = $dbLogs->concat($sessionLogs);
        $totalCalories = $allLogs->sum('calories');

        return response()->json([
            'success' => true,
            'workouts' => $allLogs->values(),
            'total_calories' => $totalCalories
        ]);
    }

    public function addWorkoutLog(Request $request)
    {
        $request->validate([
            'exercise_name' => 'required|string',
            'calories' => 'required|numeric'
        ]);

        $user = Auth::user();
        $logData = [
            'user_id' => $user->id,
            'date' => Carbon::today(),
            'exercise_name' => $request->exercise_name,
            'calories' => $request->calories,
            'updated_at' => now(),
            'created_at' => now()
        ];

        try {
            // Try DB first
            if (Schema::hasTable('workout_logs')) {
                $log = WorkoutLog::create($logData);
                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm bài tập',
                    'log' => $log
                ]);
            }
            throw new \Exception("Table missing");
        } catch (\Exception $e) {
            // Fallback to Session
            $logData['id'] = 'temp_' . uniqid(); // Temp ID
            
            $logs = session('workout_logs', []);
            $logs[] = $logData;
            session(['workout_logs' => $logs]);

            return response()->json([
                'success' => true,
                'message' => 'Đã thêm bài tập (Lưu tạm)',
                'log' => $logData
            ]);
        }
    }

    public function deleteWorkoutLog($id)
    {
        $user = Auth::user();
        
        // Try DB delete
        try {
            if (Schema::hasTable('workout_logs')) {
                $log = WorkoutLog::where('user_id', $user->id)->find($id);
                if ($log) {
                    $log->delete();
                    return response()->json(['success' => true]);
                }
            }
        } catch (\Exception $e) {
            // Ignore DB error
        }

        // Try Session delete
        $logs = session('workout_logs', []);
        $found = false;
        $logs = array_filter($logs, function($log) use ($id, &$found) {
            if (isset($log['id']) && $log['id'] == $id) {
                $found = true;
                return false; // Remove
            }
            return true;
        });

        if ($found) {
            session(['workout_logs' => array_values($logs)]); // Re-index array
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy bài tập'], 404);
    }

    public function resetDailyWorkouts()
    {
        $user = Auth::user();
        
        // Try DB reset
        try {
            if (Schema::hasTable('workout_logs')) {
                WorkoutLog::where('user_id', $user->id)
                    ->whereDate('date', Carbon::today())
                    ->delete();
            }
        } catch (\Exception $e) {
            // Ignore
        }

        // Clear Session logs
        session()->forget('workout_logs');

        return response()->json(['success' => true]);
    }

    // =================== MEAL LOGIC ===================

    public function addMealLog(Request $request)
    {
        $request->validate([
            'calories' => 'required|numeric'
        ]);

        $user = Auth::user();
        $today = Carbon::today();

        try {
            // Try DB first
            if (Schema::hasTable('daily_stats')) {
                $stat = DB::table('daily_stats')
                    ->where('user_id', $user->id)
                    ->where('date', $today->format('Y-m-d'))
                    ->first();

                if ($stat) {
                    DB::table('daily_stats')
                        ->where('id', $stat->id)
                        ->increment('calories_consumed', $request->calories);
                    $total = $stat->calories_consumed + $request->calories;
                } else {
                    DB::table('daily_stats')->insert([
                        'user_id' => $user->id,
                        'date' => $today->format('Y-m-d'),
                        'calories_burned' => 0,
                        'calories_consumed' => $request->calories,
                        'workouts_completed' => 0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    $total = $request->calories;
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm bữa ăn',
                    'total_consumed' => $total
                ]);
            }
            throw new \Exception("Table missing");
        } catch (\Exception $e) {
            // Fallback to Session
            $mealLogs = session('meal_logs', []);
            $todayMeals = collect($mealLogs)->filter(function($log) use ($today) {
                return Carbon::parse($log['date'])->isSameDay($today);
            });
            
            $mealLogs[] = [
                'user_id' => $user->id,
                'date' => $today->format('Y-m-d'),
                'calories' => $request->calories,
                'created_at' => now()
            ];
            
            session(['meal_logs' => $mealLogs]);
            
            $total = $todayMeals->sum('calories') + $request->calories;

            return response()->json([
                'success' => true,
                'message' => 'Đã thêm bữa ăn (Lưu tạm)',
                'total_consumed' => $total
            ]);
        }
    }

    // =================== PAYMENT LOGIC ===================

    public function updatePlan(Request $request)
    {
        $request->validate([
            'plan' => 'required|string|max:50'
        ]);

        try {
            // Only store plan in Session
            session(['user_plan' => $request->plan]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật gói thành công!',
                'plan' => $request->plan
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 500);
        }
    }
}
