<?php

use App\Enums\SubscriptionState;
use App\Livewire\Subscribe;
use App\Services\SubscriptionService;
use Livewire\Livewire;

$valid_email = 'test@example.com';
$valid_olx_url = 'https://www.olx.ua/d/uk/obyavlenie/klavatura-magic-keyboard-with-touch-id-and-numeric-black-mmmr3-IDX73jv.html';

test('subscribe screen can be rendered', function () {
    $response = $this->get('/subscribe');
    $response->assertStatus(200);
});


test('subscribes existing user with valid email and url', function () use ($valid_email, $valid_olx_url) {
    $service = Mockery::mock(SubscriptionService::class);
    $service->shouldReceive('addSubscription')
        ->andReturn(SubscriptionState::SUBSCRIBED);

    Livewire::test(Subscribe::class)
        ->set('email', $valid_email)
        ->set('url', $valid_olx_url)
        ->call('subscribe', $service)
        ->assertRedirectContains('/subscribed?state=' . SubscriptionState::SUBSCRIBED->value);
});