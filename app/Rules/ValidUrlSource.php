<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class ValidUrlSource implements ValidationRule
{
    private array $sources = [
        'olx.ua',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // TODO add regexp validation
        // check for supported domains
        foreach ($this->sources as $source) {
            if (!stristr($value, $source)) {
                $fail('Unsupported url source.');
                return;
            }
        }

        $response = Http::get($value);

        // check for url response availability
        if ($response->failed() || stristr($response->body(), 'noscript')) {
            $fail('Invalid url or resource is down. Unable to get url response.');
        }
    }
}