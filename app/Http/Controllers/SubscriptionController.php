<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Notifications\PriceUpdateNotification;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Services\SubscriptionService;
use App\Exceptions\ExtractorResponseException;
use App\Http\Requests\StoreSubscriptionRequest;

class SubscriptionController extends Controller
{
    public function __construct(
        private SubscriptionService $subscriptionService,
    ) {
    }

    public function index(): View
    {
        return view('subscription.index', ['items' => Listing::all()]);
    }

    public function store(StoreSubscriptionRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->subscriptionService->addSubscription($data['url'], $data['email']);
            return redirect()->route('subscription.index')->with('message', 'Subscription created successfully.');
        } catch (\Throwable $exception) {
            $message = $exception instanceof ExtractorResponseException
                ? 'Wrong provided url.'
                : $exception->getMessage();

            return redirect()->back()
                ->with('error', $message)
                ->withInput();
        }
    }
}
