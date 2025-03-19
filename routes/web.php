<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('subscription', [SubscriptionController::class, 'create'])->name('subscription.create');
Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
Route::get('subscription/success', [SubscriptionController::class, 'success'])
    ->name('subscription.success');