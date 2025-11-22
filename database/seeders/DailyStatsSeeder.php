<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DailyStat;
use App\Models\User;
use Carbon\Carbon;

class DailyStatsSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Seed data for the last 7 days
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->format('Y-m-d');
                
                // Check if data already exists
                if (!DailyStat::where('user_id', $user->id)->where('date', $date)->exists()) {
                    DailyStat::create([
                        'user_id' => $user->id,
                        'date' => $date,
                        'calories_burned' => rand(300, 600),
                        'calories_consumed' => rand(1800, 2500),
                        'workouts_completed' => rand(0, 2),
                    ]);
                }
            }
        }
    }
}
