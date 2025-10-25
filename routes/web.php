<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home.page');


Route::get('/health',function()
{
    return view('health');
})->name('health.page');

Route::get('/fitness',function()
{
    return view('fitness');
})->name('fitness.page');


Route::get('profile',function()
{
    return view('profile');
})->name('profile.page');