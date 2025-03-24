<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\SubscriptionState;
use App\Jobs\ListingExtractorJob;
use App\Models\Listing;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\ListingRepository;
use App\Exceptions\ExtractorUrlException;
use App\Notifications\PriceUpdateNotification;
use App\Services\Etl\Sources\Olx\ListingExtractor;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class SubscriptionService
{
    public function __construct(
        private UserRepository $userRepository,
        private ListingRepository $listingRepository,
    ) {
    }

    public function addSubscription($email, $url): SubscriptionState
    {
        $user = $this->userRepository->findByEmail($email) ?? $this->createUser($email);
        $listing = $this->listingRepository->findByUrl($url) ?? $this->createListing($url);

        if ($this->userRepository->hasListing($user->id, $listing->id)) {
            return $user->email_verified_at
                ? SubscriptionState::EXISTING
                : SubscriptionState::EXISTING_UNVERIFIED;
        }

        if (!$this->userRepository->hasListing($user->id, $listing->id)) {
            $this->userRepository->attachListing($user->id, $listing->id);
        }

        return $user->email_verified_at
            ? SubscriptionState::SUBSCRIBED
            : SubscriptionState::SUBSCRIBED_UNVERIFIED;
    }

    private function createUser($email): User
    {
        $user = $this->userRepository->create($email, $password);

        event(new Registered($user));
        Auth::login($user);
        return $user;
    }

    private function createListing($url): Listing
    {
        $data = $this->fetchListing($url);

        // For manual testing purposes to don't wait for real price changed
        $data['price'] = $data['price'] + 100;

        return $this->listingRepository->findOrCreate($data);
    }

    /**
     * @throws ExtractorUrlException
     */
    private function fetchListing(string $url): array
    {
        // PHP 8.4+ supports direct method invocation on new instances
        // TODO move to factory for multiple sources
        return new ListingExtractor()->execute($url);
    }

    public function processSubscriptions(): void
    {
        $listings = $this->listingRepository->getSubscribed();

        foreach ($listings as $listing) {
            ListingExtractorJob::dispatch($listing->url);
        }
    }

    /**
     * Sends notification email
     * @param array $data
     * @return void
     */
    public function onListingExtracted(array $data): void
    {
        $listing = $this->listingRepository->findByUrl($data['url']);

        // TODO consider to move price condition to extractor job
        if ($data['price'] != $listing->price) {
            $listing->users()->whereNotNull('email_verified_at')->each(function ($user) use ($data, $listing) {
                $user->notify(new PriceUpdateNotification([
                    'url' => $listing->url,
                    'title' => $listing->title,
                    'old_price' => $listing->price,
                    'new_price' => $data['price'],
                ]));
                $listing->price = $data['price'];
                $listing->save();
            });
        }
    }

    public function removeSubscription(User $user, int $listing_id): void
    {
        $user->listings()->detach($listing_id);
    }
}