<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MealPlan;

class MealTypeSeeder extends Seeder
{
    public function run()
    {
        $types = ['breakfast', 'lunch', 'dinner', 'snack'];
        $meals = MealPlan::all();

        foreach ($meals as $meal) {
            $meal->update([
                'meal_type' => $types[array_rand($types)]
            ]);
        }
    }
}
