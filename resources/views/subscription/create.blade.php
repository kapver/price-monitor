<form method="POST" action="{{ route('subscription.store') }}">
    <label for="email">
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input placeholder="Email" id="email" type="text" name="email" value="{{  old('email', $email ?? '') }}"
               class="w-2/4 mb-2 outline-2 outline-lime-500 bg-lime-100 p-1 text-lime-600 @error('url')  @enderror"/>
    </label>
    <label for="url">
        @error('url')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if(session('error'))
            {{ session('error') }}
        @endif
        <input placeholder="URL" id="url" type="text" name="url" value="{{  old('url', $url ?? '') }}"
               class="w-2/4  mb-2 outline-2 outline-lime-500 bg-lime-100 p-1 text-lime-600 @error('url')  @enderror" />
    </label>
    @csrf
    <br/>
    <input type="submit" value="Subscribe" class="outline-2 outline-lime-500 bg-lime-100 p-1 text-lime-600" />
</form>