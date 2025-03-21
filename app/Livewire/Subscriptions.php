<?php

namespace App\Livewire;

use App\Enums\SubscriptionState;
use App\Http\Requests\StoreSubscriptionRequest;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Services\SubscriptionService;

#[Layout('components.layouts.app')]
class Subscriptions extends Component
{
    public string $url = '';

    public function addSubscription(SubscriptionService $service): void
    {
        $this->validate(['url' => new StoreSubscriptionRequest()->rules()['url']]);

        $state = $service->addSubscription(auth()->user()->email, $this->url);

        session()->flash('message', $state->getMessage());
        $this->dispatch('hide-form');
    }

    public function deleteItem(SubscriptionService $service, $id): void
    {
        $service->removeSubscription(auth()->user(), $id);

        $this->dispatch('notify', message: 'Subscription deleted successfully!');
    }

    public function render()
    {
        return view('livewire.subscriptions')->with([
            'items' => auth()->user()->listings,
        ]);
    }
}
