<?php
use \Illuminate\Support\Facades\Session;
?>


@extends('modular-forms::layouts.forms')


@section('body')

    <header>
        @include('offline.header')
    </header>

    <main class="one-col">
        <section class="content">

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
