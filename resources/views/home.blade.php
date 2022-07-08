@extends('layouts.main')

@section('content')

    <div>
        <h4>{{ __('Chateau Meiland') }}</h4>
    </div>
    <div class="grid grid-cols-2 gap-16">
        <img class="object-cover h-full rounded-sm" src={{ asset('images/chateau.jpeg') }}>
        <article>
            <p>
                {{ __('We, the Meiland / Renkema family, started the new adventure in February 2019 in the village of Beynac, eight km from the porcelain city of Limoges. You may know us from the program \'\' Ik Vertrek \'\' where we were followed in 2006 during the renovation and later running of a B&B in the castle.') }}
            </p>
            <p>
                {{ __('After a few years of searching we found this beautiful family estate. The central location and the tranquility around the castle was exactly what we were looking for.') }}
            </p>
        </article>
    </div>
    @if (session('status'))
        <div class="alert">
            {{ session('status') }}
        </div>
    @endif


@endsection
