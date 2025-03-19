@extends('layouts.guest')

@section('content')
    @if(session('message'))
        {{ session('message') }}
    @endif
    @include('subscription.create')
    <br/>
    <hr/>
    <br/>
    <table class="w-full">
        <thead>
        <tr class="bg-lime-500">
            <th class="p-1 text-left">ID</th>
            <th class="p-1 text-left">Name/URL</th>
            <th class="p-1 text-left">Users</th>
            <th class="p-1 text-left">Price</th>
            <th class="p-1 text-left">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="bg-lime-100">
                <td class="p-1 text-left">{{ $item->id }}</td>
                <td class="p-1 text-left"><a href="{{ $item->url }}">{{ $item->title }}</a></td>
                <td class="p-1 text-left">
                    @foreach($item->users as $user)
                        {{ $user->email }}<br/>
                    @endforeach
                </td>
                <td class="p-1 text-left">{{ $item->price }}</td>
                <td class="p-1 text-left">{{ $item->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection