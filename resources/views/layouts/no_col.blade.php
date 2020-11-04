@extends('layouts.components._base')


@section('body')

    @include('layouts.components.header.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.components.footer.footer')

@endsection