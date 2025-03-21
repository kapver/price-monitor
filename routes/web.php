<?php

use App\Http\Controllers\SubscriptionController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Subscribe;
use App\Livewire\Subscribed;
use App\Livewire\Subscriptions;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group([
    'middleware' => ['auth', 'verified'],
], function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('subscriptions', Subscriptions::class)->name('subscriptions');
});


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('subscribe', Subscribe::class)->name('subscribe');
Route::get('subscribed', Subscribed::class)->name('subscribed');

/**
 * Old implementation
 */
Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');

require __DIR__ . '/auth.php';
