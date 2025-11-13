<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    protected $table = 'workout_exercise';
    protected $primaryKey = 'workout_exerciseID';

    protected $fillable = [
        'name_workout',
        'muscle_group',
        'duration',
        'practice_round',
        'calories_burned',
        'urls',
        'video_urls'
    ];

    public $timestamps = false; 
}
