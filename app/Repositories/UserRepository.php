<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserRepository
{
    public function create(string $email, &$password = null): User
    {
        $password = $password ?? 'password';

        Log::debug(__METHOD__, ['password' => $password]);

        $password_hash = Hash::make($password);

        return User::create([
            'name' => '',
            'email' => $email,
            'password' => $password_hash,
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    public function hasListing($userId, $listingId)
    {
        return User::find($userId)->listings()->where('listings.id', $listingId)->exists();
    }

    public function attachListing($userId, $listingId): void
    {
        User::find($userId)->listings()->attach($listingId);
    }
}