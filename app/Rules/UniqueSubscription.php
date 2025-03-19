<?php

namespace App\Rules;

use Closure;
use App\Repositories\ListingRepository;
use Illuminate\Contracts\Validation\ValidationRule;

readonly class UniqueSubscription implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $listingRepository = new ListingRepository();

        if ($listingRepository->hasUserSubscribed(request('email'), $value)) {
            $fail('You already subscribed to this :attribute.');
        }
    }
}