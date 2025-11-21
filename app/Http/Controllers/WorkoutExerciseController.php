<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutExercise;

class WorkoutExerciseController extends Controller
{
    // danh sách bài tập
    public function index(Request $request)
    {
        $query = WorkoutExercise::query();

       
        if ($request->has('filter') && $request->filter != '') {
            $filter = $request->filter;

           
            $query->where('muscle_group', 'LIKE', "%$filter%");
        }

        $exercises = $query->orderBy('workout_exerciseID', 'asc')->get();

    
        return view('workouts', compact('exercises'));
    }

  
    public function show($id)
    {
        $exercise = WorkoutExercise::with('fitness_goal')->find($id);

        return view('workouts-detail', compact('exercise'));
    }
}
