<?php

namespace AndreaMarelli\ImetCore\Jobs;

use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ModularForms\Helpers\API\DOPA\DOPA;
use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ImetCore\Models\Animal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;


class PopulateSpecies implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Utils;

    public const description = 'Populate IMET species database by retrieving from DOPA API';

    public const common_names_csv = 'species_names_crosstab.csv';

    private $storage_cache;
    private $storage_csv;

    private $countries;
    private $common_names;
    private $all_count = 0;
    private $added_count = 0;
    private $changed_count = 0;
    private $not_changed_count = 0;

    private $imet_offline = true;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->storage_cache = Storage::disk(File::TEMP_STORAGE);
        $this->storage_csv = Storage::disk('imet_db_sql');

        // check common names CSV file exists
        try{
            if(!$this->storage_csv->exists(self::common_names_csv)){
                throw new FileNotFoundException();
            }
        } catch (FileNotFoundException $e){
            static::log('Common names CSV file not found in: '.$this->storage_csv->path(''));
            return;
        }

        // retrieve common names and countries
        $this->retrieve_common_names();
        $this->countries = Country::all()->pluck('iso3')->toArray();


        // Execute requests and parse results (per country)
        foreach ($this->countries as $i => $iso3) {

            if($this->imet_offline){
                $cache_filename = 'api_country_redlist_th_list_'.$iso3.'.json';
                if($this->storage_cache->exists($cache_filename)){
                    $api_list = json_decode($this->storage_cache->get($cache_filename));
                } else {
                    $api_list = $this->retrieve_species($iso3);
                    $this->storage_cache->put($cache_filename, json_encode($api_list));
                }
            } else {
                $api_list = $this->retrieve_species($iso3);
            }

            // Parse species list
            foreach ($api_list as $api_item) {
                $this->all_count++;

                // Retrieve from DB and compare
                $this->saveToDB($api_item);

            }
        }

        // write output
        static::log('Total species retrieved from API: ' . $this->all_count, 'info');
        static::log('Species added: ' . $this->added_count, 'info');
        static::log('Species update: ' . $this->changed_count, 'info');
        static::log('Species not changed: ' . $this->not_changed_count, 'info');
    }

    /**
     * Execute request to DOPA API
     *
     * @param $iso3
     * @return mixed
     */
    private function retrieve_species($iso3){
        $api_list = DOPA::get_country_redlist_th_list($iso3);
        static::log('Species found in DOPA API for country ' . $iso3 . ': ' . count($api_list), 'info');
        return $api_list;
    }

    /**
     * Retrieve commons names from external CSV file (old DOPA backup)
     */
    private function retrieve_common_names()
    {
        $csv_file = file($this->storage_csv->path(self::common_names_csv));
        $this->common_names = [];
        foreach ($csv_file as $csv_line){
            $line = str_getcsv($csv_line,  '|');
            $this->common_names[$line[0]] = [
                'en' => $line[24],
                'fr' => $line[31],
                'sp' => $line[97],
            ];
        }
    }

    /**
     * Compare API item to DB item and save eventual changes to DB
     *
     * @param $api_item
     */
    private function saveToDb($api_item)
    {
        list($genus, $species) = explode(' ', $api_item->binomial);
        $db_item = Animal::where(
            [
                'order' => $api_item->order,
                'family' => $api_item->family,
                'genus' => $genus,
                'species' => $species
            ]
        )->first();

        // Not found : add
        if ($db_item === null) {
            $db_item = new Animal();
            $this->apply_values($db_item, $api_item);
            $db_item->save();
            $this->added_count++;
        } // Found
        else {
            $this->apply_values($db_item, $api_item);
            // Changed: update
            if ($db_item->isDirty()) {
                $this->changed_count++;
                $db_item->save();
            }
            // Not Changed: do nothing
            else {
                $this->not_changed_count++;
            }
        }

    }

    /**
     * Apply API values to DB model
     *
     * @param $db_item
     * @param $api_item
     */
    private function apply_values($db_item, $api_item)
    {
        list($genus, $species) = explode(' ', $api_item->binomial);
        $db_item->genus = $genus;
        $db_item->species = $species;
        $db_item->family = $api_item->family;
        $db_item->order = $api_item->order;
        $db_item->class = $api_item->class;
        $db_item->phylum = $api_item->phylum;
        $db_item->kingdom = $api_item->kingdom;
        $db_item->iucn_redlist_id = $api_item->id_no;
        $db_item->iucn_redlist_category = $api_item->code;
        $db_item->common_name_en = static::addCommonName($db_item->common_name_en,$this->common_names[$api_item->id_no]['en'] ?? null);
        $db_item->common_name_fr = static::addCommonName($db_item->common_name_fr,$this->common_names[$api_item->id_no]['fr'] ?? null);
        $db_item->common_name_sp = static::addCommonName($db_item->common_name_sp,$this->common_names[$api_item->id_no]['sp'] ?? null);
        $db_item->country_distribution = static::addCountry($db_item->country_distribution, $api_item->iso3_country);
    }


    /**
     * Add a country to country_distribution json field
     *
     * @param $countries
     * @param $iso3
     * @return string
     */
    private static function addCountry($countries, $iso3): string
    {
        $countries = ($countries == null or $countries == '') ? [] : json_decode($countries);
        if (!in_array($iso3, $countries)) {
            $countries[] = $iso3;
        }
        return json_encode($countries);
    }

    /**
     * Add a common name to comma-separated list
     *
     * @param $db_names
     * @param $csv_names
     * @return string
     */
    private static function addCommonName($db_names, $csv_names): string
    {
        $db_names = ($db_names === null or $db_names === '') ? [] : explode(',', $db_names);
        $csv_names = ($csv_names === null or $csv_names === '')===null ? [] : explode(',', $csv_names);
        foreach ($csv_names as $name) {
            $name = trim($name);
            if (!in_array($name, $db_names)) {
                $db_names[] = $name;
            }
        }
        return implode(',', $db_names);
    }


}
