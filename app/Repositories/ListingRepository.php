<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Listing;

class ListingRepository
{
    public function findOrCreate(array $data): Listing
    {
        return Listing::firstOrCreate(['url' => $data['url']], [
            'title' => $data['title'],
            'price' => $data['price'],
        ]);
    }

    public function hasUserSubscribed(string $email, string $url): bool
    {
        return Listing::query()
            ->join('listing_subscriptions', 'listing_subscriptions.listing_id', 'listings.id')
            ->join('users', 'users.id', 'listing_subscriptions.user_id')
            ->where('users.email', $email)
            ->where('listings.url', $url)
            ->exists();
    }
}