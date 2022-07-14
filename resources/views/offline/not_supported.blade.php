<?php
// Force Authentication of user 0
\Illuminate\Support\Facades\Auth::login((new App\Models\User)->find(0), true);

//Retrieve Browser and version
$agent = new \Jenssegers\Agent\Agent();
$browser = $agent->browser();
$version = $agent->version($agent->browser());
?>

@extends('layouts.admin')

@section('admin_breadcrumbs')

@endsection

@section('content')

    <div class="text-center">

        <h1 class="strong">Browser not supported.</h1>

        <div>Current browser:</div>
        <span class="text-2xl">Browser</span>
        <span class="field-disabled">{{ $browser }}</span>
        <br />
        <span class="text-2xl">Version</span>
        <span class="field-disabled">{{ $version }}</span>
        <br />
        <br />

        <div>IMET Offline tools requires one of the following browsers:</div>
        <div> - <b>Google Chrome</b> (version 80 or above)</div>
        <div> - <b>Mozilla Firefox</b> (version 72 or above)</div>
    </div>

    <br />
    <br />
    <br />

@endsection


