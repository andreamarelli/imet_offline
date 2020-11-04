@extends('layouts.error')

@section('page_content')
    <div class="text-center">
        <h1>ERROR 404: Not found</h1>
        <h3>Cette page n’existe pas.</h3>
        <br />
        <br />
        <a class="btn-nav big rounded" href="{{ url('/') }}">@lang('layout.home')</a>
        <div style="height: 400px">
            @if(!app()->environment('production') && isset($errors))
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