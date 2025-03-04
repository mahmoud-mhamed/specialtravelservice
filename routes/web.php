<?php

use Illuminate\Support\Facades\Route;

//return \App\Services\QNBService::make(44,333.5)->setDescription('test')->pay();


Route::get('/version', function () {
    return 1.5;
});
Route::get('/', function () {
    return \Inertia\Inertia::render('Soon');
})->name('landing.home');
Route::get('/command', function () {
    Artisan::call('migrate --force');
    Artisan::call('storage:link');
    return 'success';
});
Route::get('/fresh', function () {
    Artisan::call('migrate:fresh --force');
    Artisan::call('db:seed --force');
    return 'success';
});
