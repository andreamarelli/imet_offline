<?php
/** @var bool  $only_logo */
$only_logo = $only_logo ?? false;
?>

@extends('layouts.components._base', ['only_logo' => $only_logo])

@section('body')

    @include('layouts.components.header.header')

    @yield('page_header')

    <main class="container">

        <section class="main one-col row">
            <div class="content">
                @yield('page_content')
            </div>
        </section>

    </main>

    @include('layouts.components.footer.footer')

@endsection