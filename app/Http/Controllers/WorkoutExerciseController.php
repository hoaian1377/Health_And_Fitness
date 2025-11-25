<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutExercise;
use App\Models\FitnessGoal;

class WorkoutExerciseController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter; // Lấy ID mục tiêu từ URL

        $query = WorkoutExercise::query();

        if(!empty($filter)) {
            $query->where('fitness_goalID', $filter);
        }

        $exercises = $query->orderBy('workout_exerciseID', 'asc')->get();

        // Lấy danh sách mục tiêu từ DB
        $goals = \App\Models\FitnessGoal::all();

        return view('workouts', compact('exercises','goals','filter'));
    }

    // Chi tiết bài tập
    public function show($id)
    {
        $exercise = WorkoutExercise::find($id);
        return view('workouts-detail', compact('exercise'));
    }
    
}
