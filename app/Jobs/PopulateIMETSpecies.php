<?php

namespace App\Jobs;

use App\Library\API\DOPA\DOPA;
use App\Library\Utils\File\File;
use App\Models\Country;
use App\Models\Species\Animal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PopulateIMETSpecies implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Utils;

    public const description = 'Populate IMET species database by retrieving from DOPA API';

    public const common_names_csv = 'species_names_crosstab.csv';

    private $storage;
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
        $this->storage = \Storage::disk(File::PRIVATE_STORAGE);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // check common names CSV file exists
        try{
            if(!$this->storage->exists(self::common_names_csv)){
                throw new FileNotFoundException();
            }
        } catch (FileNotFoundException $e){
            static::log('Common names CSV file not found in: '.$this->storage->path(''));
            return;
        }

        // retrieve common names and countries
        $this->retrieve_common_names();
        $this->retrieve_countries();

        // Execute requests and parse results (per country)
        foreach ($this->countries as $i => $iso3) {

            // Execute request to DOPA API
            $api_list = DOPA::get_country_redlist_th_list($iso3);
            static::log('Species found in DOPA API for country ' . $iso3 . ': ' . count($api_list), 'info');

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
     * Retrieve commons names from external CSV file (old DOPA backup)
     */
    private function retrieve_common_names()
    {
        $csv_file = file($this->storage->path(self::common_names_csv));
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
     * Retrieve BIOPAMA countries (from IMET table)
     */
    private function retrieve_countries()
    {
        $country = new Country();

        if($this->imet_offline){
            $country->forceImetTable();
            $country = $country->notOfac();
        } else {
            $country = $country->ofac();
        }

        $this->countries = $country
            ->get()
            ->pluck('iso3')
            ->toArray();
    }

    /**
     * Compare API item to DB item and save eventual changes to DB
     *
     * @param $api_item
     */
    private function saveToDb($api_item)
    {
        $db_item = Animal::getByTaxonomy($api_item->binomial, $api_item->family, $api_item->order);

        // Not found : add
        if ($db_item->isEmpty()) {
            $db_item = new Animal();
            $this->apply_values($db_item, $api_item);
            $this->apply_values($db_item, $api_item);
            $db_item->save();
            $this->added_count++;
        } // Found
        else {
            $db_item = $db_item->first();
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
    private static function addCountry($countries, $iso3)
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
    private static function addCommonName($db_names, $csv_names)
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