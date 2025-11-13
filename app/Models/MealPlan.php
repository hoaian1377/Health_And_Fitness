<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    //
    protected $table = 'meal_plan';
    protected $primaryKey = 'meal_planID';
    protected $fillable = [
        'meal_name',
        'calories',
        'protein',
        'carbs',
        'fat',
        'food_weight',
        'urls',
        'description',
        'fitness_goalID'
    ];
    public function fitness_goal()
    {
        return $this->belongsTo(FitnessGoal::class,'fitness_goalID');
    }
}
