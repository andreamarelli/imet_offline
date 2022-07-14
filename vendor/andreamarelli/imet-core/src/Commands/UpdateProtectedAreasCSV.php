<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateProtectedAreasCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:update_pas_csv {filename} {countries?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update protected areas from Protected Planet CSV file (to be placed in storage/app/public/) and generate a SQL file';

    private $storage;
    private $sql_file;
    private $file_prefix;

    private $sql_query = '';
    private $count_csv = 0;
    private $count_csv_ww = 0;
    private $count_add = 0;
    private $count_no_change = 0;
    private $count_update = 0;
    private $multiple_countries_pas = [];

    private $all_countries_worldwide = false;

    /**
     * Protected Planet CSV columns
     */
    private const CSV_COLS = [
        'TYPE' => 0,
        'WDPAID' => 1,
        'WDPA_PID' => 2,
        'PA_DEF' => 3,
        'NAME' => 4,
        'ORIG_NAME' => 5,
        'DESIG' => 6,
        'DESIG_ENG' => 7,
        'DESIG_TYPE' => 8,
        'IUCN_CAT' => 9,
        'INT_CRIT' => 10,
        'MARINE' => 11,
        'REP_M_AREA' => 12,
        'GIS_M_AREA' => 13,
        'REP_AREA' => 14,
        'GIS_AREA' => 15,
        'NO_TAKE' => 16,
        'NO_TK_AREA' => 17,
        'STATUS' => 18,
        'STATUS_YR' => 19,
        'GOV_TYPE' => 20,
        'OWN_TYPE' => 21,
        'MANG_AUTH' => 22,
        'MANG_PLAN' => 23,
        'VERIF' => 24,
        'METADATAID' => 25,
        'SUB_LOC' => 26,
        'PARENT_ISO3' => 27,
        'ISO3' => 28,
        'SUPP_INFO' => 29,
        'CONS_OBJ' => 30
    ];


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->storage = Storage::disk('');
        $this->file_prefix = date("Y-m-d"). '_update_pas';
        $this->sql_file = $this->file_prefix . '.sql';
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle(): int
    {
        $csv_filename = $this->argument('filename');
        $csv_filepath = Storage::disk(File::PUBLIC_STORAGE)->path($csv_filename);

        // Retrieve countries
        $countries = $this->argument('countries');
        $countries = $countries ? explode(',',$countries) : [];
        if(empty($countries) and !$this->all_countries_worldwide){
            # From protected areas table
            $countries = ProtectedArea::getCountries()
                ->pluck('iso3')
                ->toArray();
        }

        // Retrieve protected areas from DB
        $pas_db = ProtectedArea::all();
        $pas_db = $pas_db->keyBy('wdpa_id');  // keyed by wdpa

        // Retrieve protected areas from CSV
        $pas_csv = [];

        $row_idx = 0;
        $handle = fopen($csv_filepath, "r");
        while (($row_data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Check CSV columns list is as expected
            if($row_idx === 0){
                $cols = array_map( function($item){ return str_replace('﻿', '', $item); }, $row_data);
                if($cols !== array_keys(static::CSV_COLS)){
                    $this->error('Error: CSV columns do not correspond to what expected');
                    return 1;
                }
            } else {

                // Compare CSV protected areas to DB
                if($this->all_countries_worldwide || in_array($row_data[static::CSV_COLS['ISO3']], $countries)){

                    // Skip if multi-country PA had been already parsed
                    if(in_array($row_data[static::CSV_COLS['WDPAID']], $this->multiple_countries_pas)){
                        continue;
                    }

                    $pa = $pas_db[$row_data[static::CSV_COLS['WDPAID']]] ?? null;
                    $attributes = $this->set_attributes($row_data);

                    // Not found: INSERT
                    if($pa===null){
                        $this->count_add++;
                        $attributes['global_id'] = 'www_' . $row_data[static::CSV_COLS['WDPAID']];
                        $this->sql_query .= $this->insert_sql($attributes).PHP_EOL;
                    } else {
                        $pa->fill($attributes);
                        // Found differences: UPDATE
                        if($pa->isDirty()){
                            $this->count_update++;
                            $this->sql_query .= $this->update_sql($attributes).PHP_EOL;
                        }
                        // No changes
                        else {
                            $this->count_no_change++;
                        }
                    }

                    $this->count_csv++;
                }
                $this->count_csv_ww++;
            }
            $row_idx++;
        }
        fclose($handle);

        // Job completed
        $this->info('------------------------------------------------------------');
        $this->info('Total countries analyzed: ' . count($countries));
        $this->info('Total protected areas retrieved from CSV (worldwide): ' . $this->count_csv_ww);
        $this->info('Total protected areas retrieved from CSV (existing countries): ' . $this->count_csv);
        $this->info('Total protected areas retrieved from DB: ' . count($pas_db));
        $this->info('Total protected areas UPDATED: ' .$this->count_update);
        $this->info('Total protected areas ADDED: ' .$this->count_add);
        $this->info('Total protected areas with NO CHANGES: ' .$this->count_no_change);
        $this->info('------------------------------------------------------------');

        // Save SQL file
        if($this->storage->exists($this->sql_file)){
            $this->storage->delete($this->sql_file);
        }
        $this->sql_query = 'BEGIN;' . PHP_EOL . $this->sql_query .'COMMIT;';
        $this->storage->put($this->sql_file, $this->sql_query);

        $this->info('SQL file saved in : ' .$this->storage->path($this->sql_file));
        $this->info('------------------------------------------------------------');

        return 0;
    }

    /**
     * Prepare attributes to
     *
     * @param $api
     * @return array
     */
    private function set_attributes($csv_data): array
    {
        $countries = '';
        if(strlen($csv_data[static::CSV_COLS['ISO3']]) > 3){
            foreach (explode(';', $csv_data[static::CSV_COLS['ISO3']]) as $c){
                $countries .= $c . ';';
            }
            $countries = rtrim($countries, ';');
            $this->multiple_countries_pas[] = $csv_data[static::CSV_COLS['WDPAID']];
        } else {
            $countries = $csv_data[static::CSV_COLS['ISO3']];
        }
        return [
            'country' => $countries,
            'wdpa_id' => $csv_data[static::CSV_COLS['WDPAID']],
            'name' => $csv_data[static::CSV_COLS['ORIG_NAME']],
            'iucn_category' => $csv_data[static::CSV_COLS['IUCN_CAT']],
            'area' => (float) $csv_data[static::CSV_COLS['REP_AREA']]
        ];
    }

    /**
     * Generate raw sql INSERT query
     *
     * @param array $attributes
     * @return string
     */
    private function insert_sql(array $attributes): string
    {
        return "INSERT INTO " . (new ProtectedArea)->getTable() . " " .
            "(" . join(", ", array_keys($attributes)) . ") " .
            "VALUES ('".join( "', '", array_map(
                function($item){ return str_replace("'", "''", $item) ;},
                array_values($attributes)
            ))."');";
    }

    /**
     * Generate raw sql UPDATE query
     *
     * @param array $attributes
     * @return string
     */
    private function update_sql(array $attributes): string
    {
        $sql = "UPDATE " . (new ProtectedArea)->getTable() . " SET ";
        foreach ($attributes as $key => $value){
            $sql .= $key . " = '" . str_replace("'", "''", $value) ."', ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE wdpa_id = '" .$attributes["wdpa_id"] . "';";
        return $sql;
    }


}
