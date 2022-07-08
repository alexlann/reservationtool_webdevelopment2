@extends('layouts.main')

@section('content')
    <h4>{{ __('Clients') }}</h4>
    <div class="mb-6">
      <a class="px-3 py-2 border border-green-400 rounded-sm uppercase text-green-400 text-sm hover:text-zinc-900 hover:border-zinc-900" href="./clients/create">{{ __('Add client') }}</a>
    </div>
    <table>
      <thead>
        <tr>
          <th scope="col" width="200">{{ __('Name') }}</th>
          <th scope="col" width="200">{{ __('Email') }}</th>
          <th scope="col" width="300">{{ __('Action') }}</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{  __($client->title) }} {{ $client->firstname }} {{ $client->lastname }}</td>
                <td>{{ $client->email }}</td>
                <td class="flex gap-1 flex-wrap">
                    <a href="./reservations/create/{{ $client->id }}" class="px-3 py-2 border border-orange-400 rounded-sm uppercase text-orange-400 text-sm hover:text-zinc-900 hover:border-zinc-900">
                        {{ __('Book a room') }}
                    </a>
                    <a href="./clients/create/{{ $client->id }}" class="px-3 py-2 border border-blue-400 rounded-sm uppercase text-blue-400 text-sm hover:text-zinc-900 hover:border-zinc-900">
                        {{ __('Update') }}
                    </a>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-rose-600 pb-1">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('clients.delete', $client->id) }}" method="POST">
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
@endsection
