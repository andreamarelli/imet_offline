@extends('layouts.components._base')


@section('body')

    @include('layouts.components.header.error')

    <main class="container">

        <section class="main one-col row">
            <div class="content">
                @yield('page_content')
            </div>
        </section>

    </main>

    @include('layouts.components.footer.footer')

@endsection
