@extends('layouts.error')

@section('page_content')
    <div class="text-center">
        <h1>ERROR 400: Bad Request</h1>
        <h3>Oups! La requette semble invalide.</h3>
        <br />
        <br />
        <a class="btn-nav big rounded" href="{{ url('/') }}">@lang('layout.home')</a>
        <div style="height: 400px">
            @if(!App::environment('production'))
                @isset($errors)
                    <br />{!! json_encode($errors->getBags()) !!}
                @endisset
                @isset($exception)
                    <br />{{ dump($exception) }}
                @endisset
            @endif
        </div>
    </div>
@endsection