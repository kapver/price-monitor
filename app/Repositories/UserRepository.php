<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    public function findOrCreate($email): User
    {
        return User::firstOrCreate(['email' => $email], [
            'name' => '',
            'password' => Hash::make(Str::random(8)),
        ]);
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