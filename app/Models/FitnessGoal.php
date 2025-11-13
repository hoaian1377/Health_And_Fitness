<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitnessGoal extends Model
{
    //
    protected $table='fitness_goal';
    protected $primaryKey = 'fitness_goalID';
    protected $fillable = [
        'goal_name',
        'description'
    ];
}
