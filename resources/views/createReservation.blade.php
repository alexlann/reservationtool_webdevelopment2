@extends('layouts.main')

@section('content')
    <h4>@if ($reservation){{ __('Edit reservation') }}@else{{ __('New reservation') }}@endif</h4>
    <div class="flex justify-between mb-3">
        <div>
            {{ __('Booking for') }}: <b>{{  __($client->title) }} {{ $client->firstname }} {{ $client->lastname }}</b>
        </div>
        <form class="flex gap-3" action={{ URL::current() }} method="GET">
            <div>
                {{ __('From') }}:
            </div>
            <div>
                <input name="date_start" value="@if (isset($_GET['date_start'])){{ $_GET['date_start'] }}@elseif ($reservation){{ $reservation->date_start_ymd }}@endif" type="date" class="datepicker" />
            </div>
            <div>
                {{ __('Until') }}:
            </div>
            <div>
                <input name="date_end" value="@if (isset($_GET['date_end'])){{ $_GET['date_end'] }}@elseif ($reservation){{ $reservation->date_end_ymd }}@endif" type="date" class="datepicker" />
            </div>
            <input class="h-42px cursor-pointer px-3 py-2 bg-blue-400 rounded-sm uppercase text-white text-sm hover:text-zinc-50 hover:bg-zinc-900" type="submit" value="{{ __('Search') }}" />
        </form>
    </div>


    @if (isset($_GET['date_end']) || $reservation)
        <table  class="min-w-full">
        <thead class="bg-zinc-50 border-b border-zinc-200">
            <tr>
            <th class="px-6 py-3 text-left font-medium text-zinc-900" scope="col" width="200">{{ __('Room') }}</th>
            <th class="px-6 py-3 text-left font-medium text-zinc-900" scope="col" width="200">{{ __('Availability') }}</th>
            <th class="px-6 py-3 text-left font-medium text-zinc-900" scope="col" width="200">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr class="odd:bg-white even:bg-zinc-100">
                <td class="px-6 py-4 text-zinc-600">{{ ucfirst($room->name) }}</td>
                <td class="px-6 py-4 text-zinc-600">
                    <div class="border height-full p-2
                        @if (isset($reservation->room_id) && $reservation->room_id == $room->id)
                            {{ "bg-blue-200 border-blue-400" }}
                        @elseif (in_array($room->id, $unavailableRooms))
                            {{ "bg-orange-200 border-orange-400" }}
                        @else
                            {{ "bg-green-200 border-green-400" }}
                        @endif
                    ">
                        <h7>
                            @if (isset($reservation->room_id) && $reservation->room_id == $room->id)
                                {{__('Current room')}}
                            @elseif (in_array($room->id, $unavailableRooms))
                                {{__('Unavailable')}}
                            @else
                                {{__('Available')}}
                            @endif
                        </h7>
                    </div>
                </td>
                <td class="px-6 py-4 text-zinc-600">
                    <form method="POST" action="{{ isset($reservation) ? route('reservations.update', $reservation->id) : route('reservations.store') }}">
                        @if ($reservation)
                            @method('PUT')
                        @endif
                        @csrf
                        <div>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                            <input type="hidden" name="date_start" value="
                                @if (isset($_GET['date_start']))
                                    {{ $_GET['date_start'] }}
                                @elseif ($reservation)
                                    {{ $reservation->date_start }}
                                @endif
                            ">
                            <input type="hidden" name="date_end" value="
                                @if (isset($_GET['date_end']))
                                    {{ $_GET['date_end'] }}
                                @elseif ($reservation)
                                    {{ $reservation->date_end }}
                                @endif
                            ">
                            <button class="px-3 py-2 border border-green-400 rounded-sm uppercase text-green-400 text-sm hover:text-zinc-900 hover:border-zinc-900 disabled:border-zinc-200 disabled:text-zinc-200" type="submit" @if(isset($reservation->room_id) && $reservation->room_id == $room->id) {{''}} @elseif (in_array($room->id, $unavailableRooms)) {{'disabled'}} @endif>
                                {{ __('Book') }}
                            </button>
                        </div>
                    </form>
                </td>
                </tr>
            @endforeach
            @if ($errors->any())
                <div class="my-3 text-red-400 ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-rose-600 pb-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </tbody>
        </table>
    @endif
@endsection
