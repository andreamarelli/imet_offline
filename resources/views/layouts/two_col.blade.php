<?php
/** @var bool  $only_logo */
$only_logo = $only_logo ?? false;
$class_monitoring_indicator=$class_monitoring_indicator??null;
?>

@extends('layouts.components._base', ['only_logo' => $only_logo])


@section('body')

    @include('layouts.components.header.header')

    @yield('page_header')
   
    <main 
        @if ($class_monitoring_indicator !== null)
        class= {{$class_monitoring_indicator}}
        @else
        class="container"
        @endif>
        <section class="main two-col row">
            <nav class="sidebar col-lg-3">
                @yield('page_sidebar')
            </nav>
            <div class="content col-lg-9">
                @yield('page_content')
            </div>
        </section>

    </main>

    @include('layouts.components.footer.footer')

@endsection
