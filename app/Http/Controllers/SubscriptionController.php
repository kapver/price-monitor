<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\SubscriptionService;
use App\Http\Requests\StoreSubscriptionRequest;

class SubscriptionController extends Controller
{
    public function __construct(private SubscriptionService $subscriptionService)
    {
    }

    public function index(): View
    {
        return view('subscription.index', ['items' => Listing::all()]);
    }

    public function store(StoreSubscriptionRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $state = $this->subscriptionService->addSubscription($data['email'], $data['url']);

        return redirect()->route('subscription.index')->with('message', $state->getMessage());
    }
}
