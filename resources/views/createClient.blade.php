@extends('layouts.main')

@section('content')
    <h4>{{ $client ? __('Edit client') : __('New client') }}</h4>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-rose-600 pb-1">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action={{ $client ? route('clients.update', $client->id) : route('clients.store') }} method="POST">
        @if ($client)
            @method('PUT')
        @endif
        @csrf
        <div class="grid grid-cols-3 gap-3 mb-6">
            <div>
                <label>{{ __('Title') }}</label>
                <select class="w-full shadow-inner border-zinc-200" name="title" required value="{{ $client ? $client->title : old('title') }}">
                    <option value="Mrs." @if (old('title') == 'Mrs.')
                                            {{ 'selected' }}
                                        @elseif (isset($client->title) && $client->title=='Mrs.')
                                            {{ 'selected' }}
                                        @else
                                            {{ '' }}
                                        @endif>{{ __('Mrs.') }}</option>
                    <option value="Mr." @if (old('title') == 'Mr.')
                                            {{ 'selected' }}
                                        @elseif (isset($client->title) && $client->title=='Mr.')
                                            {{ 'selected' }}
                                        @else
                                            {{ '' }}
                                        @endif>{{ __('Mr.') }}</option>
                    <option value="Ms." @if (old('title') == 'Ms.')
                                            {{ 'selected' }}
                                        @elseif (isset($client->title) && $client->title=='Ms.')
                                            {{ 'selected' }}
                                        @else
                                            {{ '' }}
                                        @endif>{{ __('Ms.') }}</option>
                    <option value="Dr." @if (old('title') == 'Dr.')
                                            {{ 'selected' }}
                                        @elseif (isset($client->title) && $client->title=='Dr.')
                                            {{ 'selected' }}
                                        @else
                                            {{ '' }}
                                        @endif>{{ __('Dr.') }}</option>
                    <option value="Prof." @if (old('title') == 'Prof.')
                                            {{ 'selected' }}
                                        @elseif (isset($client->title) && $client->title=='Prof.')
                                            {{ 'selected' }}
                                        @else
                                            {{ '' }}
                                        @endif>{{ __('Prof.') }}</option>
                </select>
            </div>
            <div>
                <label>{{ __('First name') }}</label>
                <input class="w-full shadow-inner border-zinc-200 @error('firstname') border-rose-600 @enderror" name="firstname" type="text" required value="@if(old('firstname')){{ old('firstname') }}@elseif($client){{ $client->firstname }}@endif">
            </div>
            <div>
                <label>{{ __('Last name') }}</label>
                <input class="w-full shadow-inner border-zinc-200 @error('lastname') border-rose-600 @enderror" name="lastname" type="text" required value="@if(old('lastname')){{ old('lastname')}}@elseif($client){{ $client->lastname }}@endif">
            </div>
            <div class="col-span-2">
                <label>{{ __('Address') }}</label>
                <input class="w-full shadow-inner border-zinc-200 @error('street') border-rose-600 @enderror" name="street" type="text" required value="@if(old('street')){{ old('street')}}@elseif($address){{ $address->street }}@endif">
            </div>
            <div>
                <label>{{ __('Zip / Postal Code') }}</label>
                <input class="w-full shadow-inner border-zinc-200 @error('zipcode') border-rose-600 @enderror"  name="zipcode" type="text" required value="@if(old('zipcode')){{ old('zipcode')}}@elseif($address){{ $address->zipcode }}@endif">
            </div>
            <div>
                <label>{{ __('City') }}</label>
                <input class="w-full shadow-inner border-zinc-200 @error('city') border-rose-600 @enderror"  name="city" type="text" required value="@if(old('city')){{ old('city')}}@elseif($address){{ $address->city }}@endif">
            </div>
            <div>
                <label>{{ __('Province') }}</label>
                <input class="w-full shadow-inner border-zinc-200 @error('province') border-rose-600 @enderror"  name="province" type="text" required value="@if(old('province')){{ old('province')}}@elseif($address){{ $address->province }}@endif">
            </div>
            <div>
                <label>{{ __('Country code') }}</label>
                <input class="w-full shadow-inner border-zinc-200 @error('country_code') border-rose-600 @enderror"  name="country_code" type="text" required value="@if(old('country_code')){{ old('country_code')}}@elseif($address){{ $address->country_code }}@endif">
            </div>
            <div class="col-span-3">
                <label>{{ __('Email') }}</label>
                <input class="w-full shadow-inner border-zinc-200 @error('email') border-rose-600 @enderror"  name="email" type="email" required value="@if(old('email')){{ old('email')}}@elseif($client){{ $client->email }}@endif">
            </div>
                <input name="id" type="hidden" required value="{{ $client ? $client->id : '' }}">
            </div>
        </div>
        <div>
            <button class="px-3 py-2 border border-green-400 rounded-sm uppercase text-green-400 text-sm hover:text-zinc-900 hover:border-zinc-900" type="submit">{{ __('Save') }}</button>
        </div>
    </form>
@endsection
