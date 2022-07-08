@component('mail::message')
# {{ $client->firstname }} {{ $client->lastname }} {{ __('asked a question') }}

{{ $question }}

{{ __('Thanks,') }}<br>
{{ $client->firstname }} {{ $client->lastname }}<br>
{{ $client->email }}
@endcomponent
