@extends('layouts.error')

@section('page_content')

        <div class="text-center">
            <h1>ERROR 403: Security Error</h1>
            <h3>La requette a été bloquée pour des raisons de sécurité.</h3>
            <br />
            <br />

            @if(!App::environment('production') && isset($errors))
                <?php dump($_SESSION ?? null) ?>
                <?php dump($_SERVER) ?>
            @endif

        </div>

@endsection
