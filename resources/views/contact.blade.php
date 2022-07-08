@extends('layouts.main')

@section('content')
    <h4>{{ __('Contact') }}</h4>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-rose-600 pb-1">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form enctype="multipart/form-data" class="grid grid-cols-3 gap-3 mb-6" action={{ route('clients.contact') }} method="POST">
        @csrf
        <div>
            <label>{{ __('First name') }}</label>
            <input class="w-full shadow-inner border-zinc-200 @error('firstname') border-rose-600 @enderror" name="firstname" type="text" required value={{ old('firstname') }}>
        </div>
        <div>
            <label>{{ __('Last name') }}</label>
            <input class="w-full shadow-inner border-zinc-200 @error('lastname') border-rose-600 @enderror" name="lastname" type="text" required value={{ old('lastname') }}>
        </div>
        <div>
            <label>{{ __('Email') }}</label>
            <input class="w-full shadow-inner border-zinc-200 @error('email') border-rose-600 @enderror" name="email" type="text" required value={{ old('email') }}>
        </div>
        <div class="col-span-3">
            <label>{{ __('Question') }}</label>
            <textarea class="w-full shadow-inner border-zinc-200 @error('question') border-rose-600 @enderror" rows="4" name="question" type="text" required value={{ old('question') }}></textarea>
        </div>
        <div class="col-span-3">
            <input name="file" type="file" value={{ old('file') }}>
        </div>
        <div>
            <input type="submit" value="{{ __('Send') }}" class="cursor-pointer px-3 py-2 border border-green-400 rounded-sm uppercase text-green-400 text-sm hover:text-zinc-900 hover:border-zinc-900">
        </div>
    </form>
@endsection
