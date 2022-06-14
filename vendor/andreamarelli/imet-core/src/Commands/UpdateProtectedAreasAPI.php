<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet;
use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateProtectedAreasAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:update_pas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update protected areas from Protected Planet API and generate a SQL file';

    private $storage;
    private $sql_file;
    private $file_prefix;

    private $sql_query = '';
    private $count_api = 0;
    private $count_add = 0;
    private $count_no_change = 0;
    private $count_update = 0;
    private $multiple_countries_pas = [];


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
        // Retrieve countries from protected areas table
        $this->info('Retrieving countries...');
        $countries = ProtectedArea::getCountries()
            ->pluck('iso3')
            ->toArray();
        $this->info('Countries retrieve: ' . count($countries));

        // Retrieve protected areas
        $pas_db = ProtectedArea::all();
        $pas_db = $pas_db->keyBy('wdpa_id');  // keyed by wdpa

        foreach ($countries as $country){

            $country_pas_api = [];

            // Retrieve regional prefix (required by global_id) // TODO: still needed for import old IMET JSONs (which still using global_id instead of wdpa_id)
            $regional_prefix = explode('_', $pas_db->filter(function ($item) use ($country){
                return $item->country == $country;
            })->first()->global_id)[0];

            // Retrieve PAs from ProtectedPlanet API (with pagination)
            $this->info('Retrieving ' . $country . ' from ProtectedPlanet API...' );
            $page = 1;
            $per_page = $pas_count = 50;
            while($pas_count === $per_page){
                $pas_api = $this->get_pas_by_country($country, $page, $per_page);
                $pas_count = count($pas_api);
                $country_pas_api = array_merge($country_pas_api, $pas_api);
                $this->count_api += $pas_count;
                $page++;
            }

            // Compare API protected areas to DB
            foreach ($country_pas_api as $pa_api) {

                // Skip if multi-country PA had been already parsed
                if(in_array($pa_api->wdpa_id, $this->multiple_countries_pas)){
                    continue;
                }

                $pa = $pas_db[$pa_api->wdpa_id] ?? null;
                $attributes = $this->set_attributes($pa_api);
                // Not found: INSERT
                if($pa===null){
                    $this->count_add++;
                    $attributes['global_id'] = $regional_prefix . '_' . $pa_api->wdpa_id;
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

            }

        }

        // Save SQL file
        if($this->storage->exists($this->sql_file)){
            $this->storage->delete($this->sql_file);
        }
        $this->sql_query = 'BEGIN;' . PHP_EOL . $this->sql_query .'COMMIT;';
        $this->storage->put($this->sql_file, $this->sql_query);

        // Job completed
        $this->info('------------------------------------------------------------');
        $this->info('Total protected areas retrieved from API: ' . $this->count_api);
        $this->info('Total protected areas retrieved from DB: ' . count($pas_db));
        $this->info('Total protected areas UPDATED: ' .$this->count_update);
        $this->info('Total protected areas ADDED: ' .$this->count_add);
        $this->info('Total protected areas with NO CHANGES: ' .$this->count_no_change);
        $this->info('------------------------------------------------------------');

        return 0;
    }

    /**
     * Retrieve protected areas from ProtectedPlanet API
     *
     * @param $country
     * @param $page
     * @param $per_page
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function get_pas_by_country($country, $page, $per_page)
    {
        $cache_msg = '';
        $page_msg = $page===1 ? '' : ' (page ' . $page . ')';
        $cache_file = $this->file_prefix . '-' . $country . '-' . $page . '.json';
        if(!Storage::disk(File::TEMP_STORAGE)->exists($cache_file)){
            $api_result = ProtectedPlanet::get_by_country($country, $page, $per_page);
            Storage::disk(File::TEMP_STORAGE)->put($cache_file, json_encode($api_result));
        } else {
            $api_result = json_decode(Storage::disk(File::TEMP_STORAGE)->get($cache_file));
            $cache_msg = '(from cache) ';
        }
        $this->info('  - ' . $cache_msg . count($api_result->protected_areas). ' protected areas found.' . $page_msg);
        return $api_result->protected_areas;
    }

    /**
     * Prepare attributes to
     *
     * @param $api
     * @return array
     */
    private function set_attributes($api): array
    {
        $countries = '';
        if(count($api->countries) > 1){
            foreach ($api->countries as $c){
                $countries .= $c->iso_3 . ';';
            }
            $countries = rtrim($countries, ';');
            $this->multiple_countries_pas[] = $api->wdpa_id;
        } else {
            $countries = $api->countries[0]->iso_3;
        }
        return [
            'country' => $countries,
            'wdpa_id' => $api->wdpa_id,
            'name' => str_replace("'", "''", $api->original_name),
            'iucn_category' => $api->iucn_category->name,
            'area' => (float) $api->reported_area
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
            "VALUES ('".join( "', '", array_values($attributes))."');";
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
            $sql .= $key . " = '" . $value ."', ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE wdpa_id = '" .$attributes["wdpa_id"] . "';";
        return $sql;
    }


}
