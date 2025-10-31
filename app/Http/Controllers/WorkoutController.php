<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function show($id)
    {
        $workouts = [
            1 => [
                'name' => 'Bài tập Giảm Cân Toàn Thân',
                'video' => 'videos/giamcan.mp4',
                'meals' => [
                    ['id' => 1, 'name' => 'Ức gà hấp', 'image' => 'images/ucga.jpg'],
                    ['id' => 2, 'name' => 'Salad rau củ', 'image' => 'images/salad.jpg'],
                ],
            ],
            2 => [
                'name' => 'Tăng Cơ Bắp Toàn Diện',
                'video' => 'videos/tangco.mp4',
                'meals' => [
                    ['id' => 3, 'name' => 'Thịt bò áp chảo', 'image' => 'images/bo.jpg'],
                    ['id' => 4, 'name' => 'Sinh tố protein', 'image' => 'images/sinh-to.jpg'],
                ],
            ],
        ];

        if (!isset($workouts[$id])) {
            abort(404, 'Không tìm thấy bài tập.');
        }

        return view('workout-detail', ['workout' => $workouts[$id]]);
    }
}
