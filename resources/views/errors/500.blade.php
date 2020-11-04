@extends('layouts.error')

@section('page_content')
    <div class="text-center">
        <h1>ERROR 500: Internal Server Error</h1>
        <h3>Oups! Le serveur a rencontré un évènement inattendu ...</h3>
        <br />
        <br />
        <a class="btn-nav big rounded" href="{{ url('/') }}">@lang('layout.home')</a>
        <div style="height: 400px">
            @if(!App::environment('production') && isset($errors))
                @isset($errors)
                    <br />{{ dump($errors) }}
                @endisset
                @isset($exception)
                    <br />{{ dump($exception) }}
                @endisset
            @endif
        </div>
    </div>
@endsection