<div class="flex flex-col gap-6" xmlns:flux="http://www.w3.org/1999/html">
    <x-auth-header :title="__('Subscribe to price update')" :description="__('')" />

    <form wire:submit="subscribe" class="flex flex-col gap-6">
        <!-- Listing Url -->
        <div class="relative">
            <flux:input
                wire:model="url"
                :label="__('Listing Url')"
                type="text"
                required
                autocomplete="url"
                :placeholder="__('URL')"
            />
        </div>

        <!-- Email Address -->
        <flux:input
                wire:model="email"
                :label="__('Email address')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="Email"
        />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Subscribe') }}</flux:button>
        </div>
    </form>
    <div class="relative flex items-center justify-center">
        <hr class="absolute w-full border-t border-neutral-200 dark:border-neutral-700" />
        <span class="bg-white dark:bg-gray-800 px-4 text-gray-500 dark:text-gray-400">or</span>
    </div>
    <nav class="flex items-center justify-center gap-4">
        @auth
            <flux:link class="w-fit text-center" href="{{ url('dashboard') }}">Dashboard</flux:link>
        @else
            <flux:link class="w-fit text-center" href="{{ url('login') }}">Log in</flux:link>
            <flux:link class="w-fit text-center" href="{{ url('register') }}">Register</flux:link>
        @endauth
    </nav>
</div>
