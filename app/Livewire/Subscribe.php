<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Services\SubscriptionService;

#[Layout('components.layouts.pure')]
class Subscribe extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|url|unique_subscription')]
    public string $url = '';

    /**
     * Handle an incoming subscription request.
     */
    public function subscribe(SubscriptionService $service): void
    {
        $this->validate();

        $state = $service->addSubscription($this->email, $this->url);

        session()->flash('state', $state->value);
        session()->flash('message', $state->getMessage());

        $this->redirect(route(
            name: 'subscribed',
            absolute: false,
            parameters: [
                'state' => $state->value,
                'message' => $state->getMessage(),
            ],
        ));
    }
}
