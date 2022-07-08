@component('mail::message')
# {{ __('New reservation for') }} {{ $client->firstname }} {{ $client->lastname }}

{{ __('Client') }}: {{ $client->title }} {{ $client->firstname }} {{ $client->lastname }}<br>
{{ __('Email') }}: {{ $client->email }}<br>
{{ __('Dates') }}: {{ $reservation->date_start }} - {{ $reservation->date_end }}<br>
{{ __('Room') }}: {{ $room->name }}<br>

{{ config('app.name') }}
@endcomponent
