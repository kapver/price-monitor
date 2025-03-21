<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Latest Price Updates
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        Here you can find the most recent updates on price changes for your subscribed listings. Stay informed and never miss a deal!
                    </p>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Completed Transactions
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        Track all your finalized deals and see the history of your successful purchases.
                    </p>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Total Savings
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        Discover how much you've saved by tracking price drops on your favorite listings.
                    </p>
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    Price Trends Over Time
                </h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    Visualize price changes for your subscribed listings with an interactive graph to spot trends and make smarter decisions.
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>