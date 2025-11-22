<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyStat extends Model
{
    protected $table = 'daily_stats';

    protected $fillable = [
        'user_id',
        'date',
        'calories_burned',
        'calories_consumed',
        'workouts_completed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
