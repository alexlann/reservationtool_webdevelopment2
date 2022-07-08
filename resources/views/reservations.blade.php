@extends('layouts.main')

@section('content')
@auth
    <h4>{{ __('Reservations') }}</h4>
    <table>
        <thead>
            <tr>
            <th scope="col" width="200">{{ __('Room') }}</th>
            <th scope="col" width="200">{{ __('Name') }}</th>
            <th scope="col" width="200">{{ __('Dates') }}</th>
            <th scope="col" width="200">{{ __('Action') }}</th>
            </tr>
        </thead>
    <tbody>

    @foreach ($reservations as $reservation)
        <tr>
            <td>{{ ucfirst($reservation->room_name) }}</td>
            <td> {{ $reservation->firstname }} {{ $reservation->lastname }}</td>
            <td>{{ $reservation->date_start }} - {{ $reservation->date_end }}</td>
            <td class="flex gap-1">
                <a class="px-3 py-2 border border-blue-400 rounded-sm uppercase text-blue-400 text-sm hover:text-zinc-900 hover:border-zinc-900" href="/reservations/create/{{ $reservation->client_id }}/{{ $reservation->id }}">{{ __('Update') }}</a>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-rose-600 pb-1">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('reservations.delete', $reservation->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="px-3 py-2 underline rounded-sm text-red-400 text-sm hover:text-zinc-900">
                        {{ __('Delete') }}
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
    @if (session('status'))
        <div class="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('status-warning'))
        <div class="alert alert-warning">
            {{ session('status-warning') }}
        </div>
    @endif
@endauth
@endsection
