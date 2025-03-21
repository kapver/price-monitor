<div x-data="{ showForm: false }" x-on:hide-form.window="showForm = false" class="flex flex-col gap-6">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <button @click="showForm = !showForm" class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-fit">
        {{ __('New Subscription') }}
    </button>

    <div x-show="showForm" x-cloak class="flex flex-col gap-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
        <div class="flex flex-col gap-2">
            <label for="url" class="text-sm font-medium text-gray-700 dark:text-gray-300">URL</label>
            <input type="url" id="url" wire:model.trim="url"
                   class="border rounded-lg px-3 py-2 dark:bg-gray-800 dark:text-gray-200"
                   placeholder="Enter listing URL"/>
            @error('url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-4">
            <button wire:click="addSubscription"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 w-fit">
                Add Subscription
            </button>
            <button @click="showForm = false"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 w-fit">
                Cancel
            </button>
        </div>
    </div>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">Image</th>
            <th scope="col" class="px-6 py-3">Title</th>
            <th scope="col" class="px-6 py-3">Url</th>
            <th scope="col" class="px-6 py-3">Price</th>
            <th scope="col" class="px-6 py-3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400 dark:text-gray-400">No Image</span>
                    </div>
                </td>
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item['title'] }}
                </th>
                <td class="px-6 py-4">
                    {{ $item['url'] }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        {{ $item['price'] }}
                    </div>
                </td>
                <td class="px-6 py-4">
                    <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                       wire:click="deleteItem({{$item->id}})"
                       wire:confirm="Are you sure you want to delete this item?"
                    >Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
