<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Subscribe to price update')" :description="__('')" />

    <form wire:submit="subscribe" class="flex flex-col gap-6">
        <!-- Listing Url -->
        <div class="relative">
            <flux:input
                wire:model="url"
                :label="__('Listing url')"
                type="text"
                required
                autocomplete="url"
                :placeholder="__('https://www.olx.ua/d/uk/obyavlenie/iphone-14-pro-256-gb-IDXF7iC.html')"
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
                placeholder="email@example.com"
        />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Subscribe') }}</flux:button>
        </div>
    </form>
</div>
