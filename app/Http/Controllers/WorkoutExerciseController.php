<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutExercise;

class WorkoutExerciseController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter; // Lấy tab hiện tại

        // Quy định số cuối ID cho từng mục tiêu
        $goalDigits = [
            'Tăng cân' => ['0','1','2'],
            'Tăng cơ'  => ['3','4'],
            'Giảm cân' => ['5','6'],
            'Giảm mỡ' => ['7','8','9']
        ];

        $query = WorkoutExercise::query();

        if(!empty($filter) && isset($goalDigits[$filter])) {
            $digits = $goalDigits[$filter];
            $query->where(function($q) use ($digits) {
                foreach($digits as $d) {
                    $q->orWhere('workout_exerciseID', 'LIKE', "%$d");
                }
            });
        }

        $exercises = $query->orderBy('workout_exerciseID', 'asc')->get();

        // Các tabs
        $goals = array_keys($goalDigits);

        return view('workouts', compact('exercises','goals','filter'));
    }

    // Chi tiết bài tập
    public function show($id)
    {
        $exercise = WorkoutExercise::find($id);
        return view('workouts-detail', compact('exercise'));
    }
    
}
