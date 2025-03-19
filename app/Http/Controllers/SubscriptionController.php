<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    public function __construct(
        private readonly SubscriptionService $subscriptionService,
    ) {
    }

    public function create(): View
    {
        return view('subscription.create');
    }

    public function store(StoreSubscriptionRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->subscriptionService->addSubscription($data['url'], $data['email']);
            return redirect()->route('subscription.success', $data);
        } catch (\Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function success(Request $request)
    {
        return view('subscription.success', $request->only(['url', 'email']));
    }
}
