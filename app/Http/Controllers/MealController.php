<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MealController extends Controller
{
    public function show($id)
    {
        $meals = [
            1 => [
                'name' => 'Salad Ức Gà Giảm Cân',
                'image' => 'images/meal1.avif',
        'calories' => 250,
        'time' => '15 phút',
        'rating' => 4.8,
        'desc' => 'Món salad tươi mát giúp giảm cân và giữ dáng hiệu quả.',
    ],
    2 => [
        'name' => 'Cơm Gạo Lứt & Cá Hồi',
        'image' => 'images/meal2.avif',
        'calories' => 480,
        'time' => '25 phút',
        'rating' => 4.9,
        'desc' => 'Bữa ăn giàu protein, cung cấp năng lượng cho buổi tập nặng.',
    ],
];
    }

}