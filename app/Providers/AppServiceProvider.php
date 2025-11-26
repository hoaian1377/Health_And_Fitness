<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share fitness goals with packages with the payment view
        \Illuminate\Support\Facades\View::composer('payment', function ($view) {
            $view->with('fitnessGoals', \App\Models\FitnessGoal::with('packages')->get());
        });
    }
}
