@extends('layouts.error')

@section('page_content')
    <div class="text-center">
        <h1>{{ ucfirst(trans('common.in_development')) }}</h1>
        <h3>{{ ucfirst(trans('common.page_in_development')) }}</h3>
        <br />
        <br />
        <a class="btn-nav big rounded" href="{{ route('admin_home') }}">{{ ucfirst(trans('layout.admin.admin_page')) }}</a>
    </div>
@endsection