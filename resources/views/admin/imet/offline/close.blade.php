<?php
    // Close PostgreSQL
    $tool_folder = realpath(getcwd().'\..\..');
    $pgsql_stop = '"'.$tool_folder.'\pgsql\App\PgSQL\pgsql_server_stop.cmd"';
    $WshShell = new COM("WScript.Shell");
    $WshShell->Run($pgsql_stop, 0, false);

    // Kill IMET
    exec('taskkill /F /IM ImetOfflineTool.exe');
?>