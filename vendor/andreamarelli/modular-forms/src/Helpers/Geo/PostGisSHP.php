<?php

namespace AndreaMarelli\ModularForms\Helpers\Geo;

use AndreaMarelli\ModularForms\Exceptions\MissingUploadShpException;
use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ModularForms\Helpers\File\Zip;
use BadMethodCallException;
use ErrorException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;


class PostGisSHP {

    public const TABLE_INPUT_TYPE = 1;
    public const QUERY_INPUT_TYPE = 2;

    /**
     * Import a SHP into a PostGis table (using shp2pgsql binary)
     *
     * @param $zip_path
     * @param string|null $table_name
     * @param string|null $primary_table_SRID
     * @return string
     * @throws \AndreaMarelli\ModularForms\Exceptions\MissingUploadShpException
     */
    public static function shp2pgsql($zip_path, string $table_name = null, string $primary_table_SRID = null): string
    {
        $storage = Storage::disk(File::TEMP_STORAGE);

        // Create temporary folder
        $unzip_path_prefix = md5($zip_path . now());
        $storage->makeDirectory($unzip_path_prefix);
        $unzip_path = $storage->path($unzip_path_prefix);

        // Extract files from ZIP and remove it
        $files = Zip::extract($zip_path,  $unzip_path, true, true);

        // Search for SHP file
        $shp_path = null;
        foreach ($files as $file){
            if(Str::endsWith($file, '.shp')){
                $shp_path = $file;
            }
        }
        if($shp_path===null){
            throw new MissingUploadShpException();
        }

        // Convert SHP to PostGis (with shp2pgsql binary) and return temporary table name
        $temporary_table = static::execute_shp2pgsql($shp_path, $table_name, $primary_table_SRID);

        // Remove SHP files
        $storage->deleteDirectory($unzip_path_prefix);
        return $temporary_table;
    }

    /**
     * Export PostGis table to SHP (using pgsql2shp binary)
     *
     * @param $shp_filename
     * @param $table_or_sql
     * @param $input_type
     * @return string
     * @throws \ErrorException
     */
    public static function pgsql2shp($shp_filename, $table_or_sql, $input_type): string
    {
        $storage = Storage::disk(File::TEMP_STORAGE);
        $filename_prefix = str_replace('.shp', '', $shp_filename);

        // Create temporary folder
        $shp_folder = md5($filename_prefix . now());
        $storage->makeDirectory($shp_folder);

        // Generate SHP (with pgsql2shp binary)
        $shp_path = $storage->path($shp_folder . '/' . $filename_prefix . '.shp');
        if($input_type === static::TABLE_INPUT_TYPE
            || $input_type === static::QUERY_INPUT_TYPE){
            static::execute_pgsql2shp($shp_path, $table_or_sql, $input_type);
        } else {
            throw new BadMethodCallException('Invalid $input_type');
        }

        // Remove existing ZIP file
        if($storage->exists($filename_prefix . '.zip')) {
            $storage->delete($filename_prefix . '.zip');
        }
        // Generate ZIP file (include SHP + side files)
        $files_to_zip = [];
        foreach ($storage->files($shp_folder) as $file) {
            $files_to_zip[] = $storage->path($file);
        }
        $zip_path = Zip::compress($files_to_zip, $filename_prefix . '.zip');

        // Remove SHP files
        $storage->deleteDirectory($shp_folder);

        return $zip_path;
    }

    /**
     * Execute a pgsql2shp command
     *
     * @param $shp_path
     * @param $table_or_sql
     * @param $input_type
     * @return void
     * @throws \ErrorException
     */
    private static function execute_pgsql2shp($shp_path, $table_or_sql, $input_type)
    {
        // Check if shp2pgsql binary path is set in .env
        if(env('PGSQL2SHP')===null){
            throw new ErrorException('PGSQL2SHP not defined in .env');
        }

        // Prepare input option
        if($input_type === static::TABLE_INPUT_TYPE ){
            $src = $table_or_sql;
        } elseif ($input_type === static::QUERY_INPUT_TYPE){
            $src = '"' . addslashes($table_or_sql) . '"';
        } else {
            throw new BadMethodCallException('Invalid $input_type');
        }

        // Prepare & execute command
        $command = env('PGSQL2SHP') .
            ' -h ' . env('DB_HOST') .
            ' -p ' . env('DB_PORT') .
            ' -u ' . env('DB_USERNAME') .
            ' -P ' . env('DB_PASSWORD') .
            ' -f ' . $shp_path .
            ' ' . env('DB_DATABASE') .
            ' ' . $src;
        static::execute_command($command . ' > /dev/null');
    }

    /**
     * Execute a shp2pgsql command
     *
     * @param string $shp_path
     * @param string|null $table_name
     * @param string|null $table_SRID
     * @return string
     */
    private static function execute_shp2pgsql(string $shp_path, string $table_name = null, string $table_SRID = null): string
    {
        // Check if shp2pgsql binary path is set in .env
        if(env('SHP2PGSQL')===null){
            dd('SHP2PGSQL not defined in .env');
        }

        // Set destination table (use SHP filename if not provided)
        $table_name = $table_name ?? Str::replace('.shp', '', Str::lower(basename($shp_path)));
        $table_name = Str::contains($table_name, '.') ? $table_name : 'public.'.$table_name;

        // Drop table if exists
        Schema::dropIfExists($table_name);

        // Prepare & execute command
        $path = rtrim(dirname($shp_path), '/') . '/';
        $sql_path = $path . 'shp2pgsql.sql';
        $set_SRID = $table_SRID!==null ? ' -s '.$table_SRID .' ' : '';
        $command = env('SHP2PGSQL') . $set_SRID . $shp_path . ' "' . $table_name . '"';
        static::execute_command($command . ' > ' . $sql_path);

        // Execute SQL command
        $relative_path = Str::replace(Storage::path(''), '', $sql_path);
        $sql = Storage::get($relative_path);
        DB::unprepared($sql);

        return $table_name;
    }

    /**
     * Execute a command
     * @param $command
     * @return void
     */
    private static function execute_command($command)
    {
        system($command, $result_code);
        if($result_code!==0){
            throw new RuntimeException('Error in executing command:  '.$command);
        }
    }


}
