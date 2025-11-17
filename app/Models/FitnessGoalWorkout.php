<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitnessGoalWorkout extends Model
{
    protected $table='fitness_goal_workout';
    protected $primaryKey = 'fitness_goal_workoutID';
    protected $fillable = ['fitness_goalID','workout_exerciseID'];

    public function workout(){
        return $this->belongsTo(WorkoutExercise::class,'workout_exerciseID');
    }
}
