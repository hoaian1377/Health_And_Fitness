<?php

namespace App\Http\Controllers;

use App\Models\WorkoutLog;
use App\Models\DailyStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WorkoutController extends Controller
{
    public function getTodayWorkouts()
    {
        $user = Auth::user();
        $today = Carbon::today()->format('Y-m-d');
        
        $workouts = WorkoutLog::where('user_id', $user->id)
            ->where('date', $today)
            ->get();
        
        $totalCalories = $workouts->sum('calories');
        
        return response()->json([
            'success' => true,
            'workouts' => $workouts,
            'total_calories' => $totalCalories
        ]);
    }

    public function addWorkout(Request $request)
    {
        $request->validate([
            'exercise_name' => 'required|string',
            'calories' => 'required|integer|min:0'
        ]);

        $user = Auth::user();
        $today = Carbon::today()->format('Y-m-d');

        $workout = WorkoutLog::create([
            'user_id' => $user->id,
            'date' => $today,
            'exercise_name' => $request->exercise_name,
            'calories' => $request->calories
        ]);

        // Update daily stats
        $stat = DailyStat::firstOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            ['calories_burned' => 0, 'calories_consumed' => 0, 'workouts_completed' => 0]
        );
        
        $stat->increment('calories_burned', $request->calories);
        $stat->increment('workouts_completed');

        return response()->json([
            'success' => true,
            'message' => 'Đã thêm bài tập',
            'workout' => $workout,
            'total_calories' => WorkoutLog::where('user_id', $user->id)
                ->where('date', $today)
                ->sum('calories')
        ]);
    }

    public function removeWorkout($id)
    {
        $user = Auth::user();
        $workout = WorkoutLog::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy bài tập'
            ], 404);
        }

        $calories = $workout->calories;
        $today = $workout->date;
        $workout->delete();

        // Update daily stats
        $stat = DailyStat::where('user_id', $user->id)
            ->where('date', $today)
            ->first();
        
        if ($stat) {
            $stat->decrement('calories_burned', $calories);
            $stat->decrement('workouts_completed');
        }

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa bài tập'
        ]);
    }

    public function resetWorkouts()
    {
        $user = Auth::user();
        $today = Carbon::today()->format('Y-m-d');

        WorkoutLog::where('user_id', $user->id)
            ->where('date', $today)
            ->delete();

        // Reset daily stats
        $stat = DailyStat::where('user_id', $user->id)
            ->where('date', $today)
            ->first();
        
        if ($stat) {
            $stat->update([
                'calories_burned' => 0,
                'workouts_completed' => 0
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa tất cả bài tập'
        ]);
    }
}
