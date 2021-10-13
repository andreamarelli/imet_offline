@extends('modular-forms::layouts._base', ['class_to_body' => 'flex-col'])


@section('body')

    <header>
        @include('offline.header')
    </header>

    <main class="one-col">
        <section class="content">

            @if (Session::has('message'))
                @include('modular-forms::page.alert', ['message' => Session::get('message'), 'alert_type' => 'success'])
            @elseif (Session::has('error_message'))
                @include('modular-forms::page.alert', ['message' => Session::get('error_message'), 'alert_type' => 'danger'])
            @endif

            <?php
            if(Session::has('lists')){
                Session::forget('lists');
            }
            ?>
            @yield('content')

        </section>
    </main>

    <footer>
        @include('offline.footer')
    </footer>

@endsection
