<?php

use Illuminate\Support\Facades\Route;

//return \App\Services\QNBService::make(44,333.5)->setDescription('test')->pay();


Route::get('/version', function () {
    return 1.8;
});
Route::get('/', function () {
    return redirect()->route('dashboard.login.view-form');
    return \Inertia\Inertia::render('Soon');
})->name('landing.home');

Route::get('/bill/{bill}/pay', \App\Actions\Bill\VisitorPayBillAction::class)->name('visitor.bill.pay');

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

Route::get('/delete-bill/{bill}', function (\App\Models\Bill $bill) {
    $bill->delete();
    return 'success';
});
