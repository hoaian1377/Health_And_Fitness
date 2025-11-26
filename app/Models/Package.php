<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    protected $table = 'package';
    protected $primaryKey = 'packageID';
    protected $fillable = [
        'name_package',
        'price',
        'duration',
        'fitness_goalID',
        'description',

    ];
    public function fitnessGoal()
    {
        return $this->belongsTo(FitnessGoal::class, 'fitness_goalID', 'fitness_goalID');
    }
}
