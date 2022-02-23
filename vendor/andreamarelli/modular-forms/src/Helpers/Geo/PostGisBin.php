<?php

namespace AndreaMarelli\ModularForms\Helpers\Geo;

use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostGisBin {

    private static function execute_command($command)
    {
        system($command, $result_code);
        if($result_code!==0){
            dd('Error in executing command:  '.$command);
        }
    }

    /**
     * Execute a shp2pgsql command
     *
     * @param string $shp_path
     * @param string $table_name
     * @param bool $drop_if_exists
     * @return string
     */
    public static function shp2pgsql($shp_path, $table_name = null, $drop_if_exists = true): string
    {
        // Check if shp2pgsql binary path is set in .env
        if(env('SHP2PGSQL')===null){
            dd('SHP2PGSQL not defined in .env');
        }

        // Set destaination table (drop if exists)
        $table_name = $table_name ?? Str::replace('.shp', '', Str::lower(basename($shp_path)));
        $table_name = Str::contains($table_name, '.') ? $table_name : 'public.'.$table_name;
        if($drop_if_exists){
            DB::unprepared('DROP TABLE IF EXISTS ' . $table_name . ';');
        }

        // Prepare & execute command
        $sql_path = $shp_path . '.sql';
        $command = env('SHP2PGSQL').' ' . $shp_path . ' "' . $table_name . '"';
        static::execute_command($command . ' > ' . $sql_path);

        // Execute SQL commnad
        $sql = Storage::disk(File::PRIVATE_STORAGE)->get(basename($sql_path));
        DB::unprepared($sql);

        return $table_name;
    }

    /**
     * Execute a pgsql2shp command
     *
     * @param string $shp_path
     * @param string $table_name
     * @return void
     */
    public static function pgsql2shp($shp_path, $table_name)
    {
        // Check if shp2pgsql binary path is set in .env
        if(env('PGSQL2SHP')===null){
            dd('PGSQL2SHP not defined in .env');
        }

        $table_name = Str::contains($table_name, '.') ? $table_name : 'public.'.$table_name;

        // Prepare & execute command
        $command = env('PGSQL2SHP') .
            ' -h ' . env('DB_HOST') .
            ' -p ' . env('DB_PORT') .
            ' -u ' . env('DB_USERNAME') .
            ' -P ' . env('DB_PASSWORD') .
            ' -f ' . $shp_path . ' ' .
            ' ' . env('DB_DATABASE') . ' ' .
            ' '. $table_name;
        static::execute_command($command . ' > /dev/null');
    }

    /**
     * Execute a pgsql2shp command through a SQL query
     *
     * @param string $shp_path
     * @param string $sql_query
     * @return void
     */
    public static function pgsql2shp_with_query($shp_path, $sql_query)
    {
        // Check if shp2pgsql binary path is set in .env
        if(env('PGSQL2SHP')===null){
            dd('PGSQL2SHP not defined in .env');
        }

        // Prepare & execute command
        $command = env('PGSQL2SHP') .
            ' -h ' . env('DB_HOST') .
            ' -p ' . env('DB_PORT') .
            ' -u ' . env('DB_USERNAME') .
            ' -P ' . env('DB_PASSWORD') .
            ' -f ' . $shp_path . ' ' .
            ' ' . env('DB_DATABASE') . ' ' .
            ' "' . addslashes($sql_query) . '"';
        static::execute_command($command . ' > /dev/null');
    }

}
