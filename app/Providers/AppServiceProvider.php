<?php

namespace App\Providers;

use App\Rules\UniqueSubscription;
use App\Rules\ValidUrlSource;
use Illuminate\Support\Facades\Validator;
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
        Validator::extend('unique_subscription', function ($attribute, $value, $parameters, $validator) {
            new UniqueSubscription()->validate(
                $attribute,
                $value,
                fn($message) => $validator->errors()->add($attribute, $message),
            );

            return true;
        });

        Validator::extend('valid_url_source', function ($attribute, $value, $parameters, $validator) {
            new ValidUrlSource()->validate(
                $attribute,
                $value,
                fn($message) => $validator->errors()->add($attribute, $message)
            );

            return true;
        });
    }
}
