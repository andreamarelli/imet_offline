<?php

$tool_folder = realpath(getcwd().'\..\..');

// Close PostgreSQL if still running
$pgsql_stop = '"'.$tool_folder.'\pgsql\App\PgSQL\pgsql_server_stop.cmd"';
$WshShell = new COM("WScript.Shell");
$WshShell->Run($pgsql_stop, 0, false);
sleep(5);

// Open a fresh new PostgreSQL instance
$pgsql_start = '"'.$tool_folder.'\pgsql\App\PgSQL\pgsql_server_start.cmd"';
$WshShell = new COM("WScript.Shell");
$WshShell->Run($pgsql_start, 0, false);

// Wait for database connection
$db_not_ready = true;
while ($db_not_ready){
    try {
        DB::connection()->getPdo();
        $db_not_ready = false;
    } catch (\Exception $e){
        sleep(1);
    }
}

// if database is empty call Job for populate
$tables = DB::select("SELECT tablename FROM pg_catalog.pg_tables where schemaname='public';");
if(empty($tables)){
    \Illuminate\Support\Facades\Artisan::call('init_imet_offline_db:jobs');
}

// Force Authentication of user 0
Auth::login(\App\User::find(0), true);

?>
        <!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IMET Offline Tool</title>

    <link rel="stylesheet" href="{{ asset(mix('vendor.css', 'assets')) }}">
    <link rel="stylesheet" href="{{ asset(mix('custom.css', 'assets')) }}">
    <script src="{{ asset(mix('lang.js', 'assets')) }}"></script>
    <script src="{{ asset(mix('vendor.js', 'assets')) }}"></script>
    <script src="{{ asset(mix('custom.js', 'assets')) }}"></script>
</head>
<body>

<style>
    .imet_offline_welcome{
        padding: 0;
    }
    header{
        background-color:#004A19;
        color: $white;
        padding: 10px 20px;
    }
    .imet_offline_version{
        padding: 5px;
    }

    .imet_offline_content{
        padding: 20px;
    }
    footer{
        background-color:#252525;
        color: $white;
        padding: 10px 20px;
    }
    .strong_alert{
        font-weight: bold;
        font-size: 1.2em;
    }
</style>

<div class="container-fluid imet_offline_welcome">

    <header>IMET Offline Tool</header>

    <div class="imet_offline_version text-right">
        version: <b class="green">{{ \App\Models\Imet\v2\Imet::imet_version }}</b>
        Database version: <b class="green">{{ \App\Models\Imet\v2\Imet::db_version }}</b>
        revision: <b class="green">{{ env('IMET_REVISION') ?? '-' }}</b>
    </div>

    <div class="imet_offline_content">
        <p>
            Access the Imet Offline Tool:
            &nbsp;&nbsp;
            <a href="/index.php/admin/confirm_user" target="_blank" class="btn btn-primary">Open IMET</a>
        </p>

        <p>
            Manage the service:
            &nbsp;&nbsp;
            <a href="/index.php/welcome" class="btn btn-success">Restart Service</a>
            <a href="/index.php/admin/imet/offline/close" class="btn btn-warning">Close</a>
        </p>
        <br />
        <div class="alert alert-danger" role="alert">
            <p class="strong_alert">
                <i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;IMPORTANT
            </p>
            Please use the above "<b>Close</b>" button to properly close the IMET Offline Tool.
        </div>
    </div>

    <footer>
        <small> Powered by
            <a href="http://github.com/cztomczak/phpdesktop" target="_blank">phpdesktop</a>
        </small>
    </footer>

</div>

</body>
</html>