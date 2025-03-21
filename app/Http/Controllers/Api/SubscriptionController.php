<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use App\Services\SubscriptionService;
use App\Http\Requests\StoreSubscriptionRequest;

class SubscriptionController extends Controller
{
    public function __construct(
        private SubscriptionService $subscriptionService,
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json([]);
    }

    public function store(StoreSubscriptionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $state = $this->subscriptionService->addSubscription($data['email'], $data['url']);

        return response()->json([
            'state' => $state->value,
            'message' => $state->getMessage(),
        ]);
    }
}
