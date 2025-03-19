<x-mail::message>
# Price update

The price for your subscription to "{{ $title }}" has changed from {{ $old_price }} to {{ $new_price }}
<x-mail::button :url="$url">Check it out</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
