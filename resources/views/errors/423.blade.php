@extends('layouts.error')

@section('page_content')
    <div class="text-center">
        <h1>ERROR 423: Locked</h1>
        <h3>{{ ucfirst($message) }}</h3>
        <br />
        <br />
        <a class="btn-nav big rounded" href="{{ url('/') }}">{{ ucfirst(trans('layout.home')) }}</a>
    </div>
@endsection