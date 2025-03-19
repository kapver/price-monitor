<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Services\SubscriptionService;
use App\Exceptions\ScraperResponseException;
use App\Http\Requests\StoreSubscriptionRequest;

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
            $message = $exception instanceof ScraperResponseException
                ? 'Wrong provided url.'
                : $exception->getMessage();

            return redirect()->back()
                ->with('error', $message)
                ->withInput();
        }
    }

    public function success(Request $request)
    {
        return view('subscription.success', [
            'url' => $request->input('url'),
            'email' => $request->input('email')
        ]);
    }
}
