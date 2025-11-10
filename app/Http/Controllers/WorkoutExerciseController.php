<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutExercise;

class WorkoutExerciseController extends Controller
{
    // danh sách bài tập
    public function index()
    {
        // Lấy tất cả (có thể paginate nếu nhiều)
        $exercises = WorkoutExercise::orderBy('workout_exerciseID', 'asc')->get();

        // Trả về view và truyền biến $exercises
        return view('workouts', compact('exercises'));
    }

    // chi tiết 1 bài tập
    public function show($id)
    {
        $exercise = WorkoutExercise::findOrFail($id);

        return view('workouts.show', compact('exercise'));
    }
}
