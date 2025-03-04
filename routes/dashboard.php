<?php

use Illuminate\Support\Facades\Route;
use \App\Actions;

Route::group([
    'middleware' => ['guest'],
], function () {
    Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
        Route::get('/', [\App\Actions\User\LoginAction::class, 'viewForm'])->name('view-form');
        Route::post('/', \App\Actions\User\LoginAction::class)->name('save');
    });
});
Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    Route::post('/logout', \App\Actions\User\UserLogoutAction::class)->name('logout');
    Route::get('/', \App\Actions\DashboardHomeAction::class)->name('home');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', \App\Actions\User\UserIndexAction::class)->name('index');
        Route::post('/', \App\Actions\User\UserStoreAction::class)->name('store');
        Route::post('/{user}', \App\Actions\User\UserUpdateAction::class)->name('update');
        Route::delete('/{user}', \App\Actions\User\UserDeleteAction::class)->name('delete');


        Route::group(['prefix' => 'profile/{user}', 'as' => 'profile.'], function () {
            Route::get('/', [\App\Actions\User\UserProfileAction::class, 'viewMainData'])->name('main_data');
            Route::get('/edit', [\App\Actions\User\UserProfileAction::class, 'viewEdit'])->name('edit');
        });
    });

    Route::group(['prefix' => 'bill', 'as' => 'bill.'], function () {
        Route::get('/', \App\Actions\Bill\BillIndexAction::class)->name('index');
        Route::get('/create', [\App\Actions\Bill\BillStoreAction::class, 'viewForm'])->name('create');
        Route::post('/store', \App\Actions\Bill\BillStoreAction::class)->name('store');
        Route::get('/{bill}/edit', [\App\Actions\Bill\BillUpdateAction::class, 'viewForm'])->name('edit');
        Route::post('/{bill}/update', \App\Actions\Bill\BillUpdateAction::class)->name('update');
        Route::delete('/{bill}', Actions\Bill\BillDeleteAction::class)->name('delete');

        Route::get('/{bill}/make-payment-link', Actions\Bill\BillMakePaymentLinkAction::class)->name('make-payment-link');

        Route::group(['prefix' => 'profile/{bill}', 'as' => 'profile.'], function () {
            Route::get('/', [\App\Actions\Bill\BillProfileAction::class, 'viewMainData'])->name('main_data');
        });

    });
});
