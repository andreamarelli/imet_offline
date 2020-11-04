@extends('layouts.components._base')


@section('body')

    @include('layouts.components.header.header')

    @component('layouts.components.main.title_ribbon')
        <span class="page_title">
            @yield('admin_page_title')
        </span>
    @endcomponent

    <main class="container">
        <section class="main one-col row">
            <div class="content">
                @if (Session::has('message'))
                    @include('admin.components.alert', ['message' => Session::get('message'), 'alert_type' => 'success'])
                @elseif (Session::has('error_message'))
                    @include('admin.components.alert', ['message' => Session::get('error_message'), 'alert_type' => 'danger'])
                @endif

                <?php
                    if(Session::has('lists')){
                        Session::forget('lists');
                    }
                ?>
                @yield('content')
            </div>
        </section>
    </main>

    @include('layouts.components.footer.footer')

@endsection