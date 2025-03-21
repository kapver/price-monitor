<div class="mt-4 flex flex-col gap-6">
    @php
        $state = request('state', session('state'));
        $message = request('message', session('message'));
    @endphp

    {{--    {{ $state }}--}}
    <flux:text class="text-center">
        @if($message)
            {{ __($message) }}
        @endif
    </flux:text>

    @if (session('status') == 'verification-link-sent')
        <flux:text class="text-center font-medium !dark:text-green-400 !text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </flux:text>
    @endif

    <div class="flex flex-col items-center justify-between space-y-3">
        <flux:button href="{{ route('subscriptions') }}" variant="primary" class="w-full">
            {{ __('Subscriptions') }}
        </flux:button>
    </div>
</div>
