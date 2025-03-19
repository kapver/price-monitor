<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');