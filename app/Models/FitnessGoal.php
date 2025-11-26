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
    public function packages()
    {
        return $this->hasMany(Package::class, 'fitness_goalID', 'fitness_goalID');
    }
}
