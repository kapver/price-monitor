<h3>OLX advertisement price updater subscription page</h3>

<form method="POST" action="{{ route('subscription.store') }}">
    @csrf

    <label for="url">
        OLX url:
        <input id="url" type="text" name="url" value="{{  old('url', $url ?? '') }}" class="@error('url') is-invalid @enderror" />
        @error('url')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </label>
    <br/>
    <label for="email">
        Email address:
        <input id="email" type="text" name="email" value="{{  old('email', $email ?? '') }}" class="@error('email') is-invalid @enderror" />
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </label>
    <br/>
    <input type="submit" value="Subscribe" />
</form>