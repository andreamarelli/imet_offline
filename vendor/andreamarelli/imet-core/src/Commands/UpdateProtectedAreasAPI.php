<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet;
use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;
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

    private string $file_prefix;

    private int $count_api = 0;
    private int $count_add = 0;
    private int $count_no_change = 0;
    private int $count_update = 0;
    private array $already_processed = [];


    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        $this->file_prefix = date("Y-m-d"). '_update_pas';
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @throws FileNotFoundException
     */
    public function handle(): int
    {

        // Retrieve countries
        $this->info('Retrieving countries...');
        $countries = Country::select(['iso3', 'region_id'])->get();
        $this->info('Countries retrieved: ' . count($countries));

        foreach ($countries as $country){

            // Retrieve PAs from DB
            $this->info('Retrieving ' . $country->iso3 . ' PAs from DB ...');
            $pas_db = ProtectedArea::where('country', $country->iso3)->get();
            $pas_db = $pas_db->keyBy('wdpa_id');  // keyed by wdpa
            $this->info('Protected areas retrieved: ' . count($pas_db));

            // Retrieve PAs from ProtectedPlanet API (with pagination)
            $this->info('Retrieving ' . $country->iso3 . ' PAs from ProtectedPlanet API...' );
            $chunk = 1;
            $per_chunk = $pas_count = 50;
            while($pas_count === $per_chunk){

                // Retrieve PAs from API
                $pas_api = $this->get_pas_by_country($country->iso3, $chunk, $per_chunk);
                $pas_count = count($pas_api);
                $this->count_api += $pas_count;
                $chunk++;

                // Compare API protected areas to DB
                foreach ($pas_api as $pa_api) {

                    // Skip already processes PAs (required for multi-country)
                    if(in_array($pa_api->wdpa_id, $this->already_processed)){
                        continue;
                    }
                    $this->already_processed[] = $pa_api->wdpa_id;

                    // Get attributes
                    $pa = $pas_db[$pa_api->wdpa_id] ?? null;
                    $attributes = $this->set_attributes($pa_api);

                    // Set global_id: still needed for import old IMET JSONs (which still using global_id instead of wdpa_id)
                    $attributes['global_id'] = $country->region_id!==null
                        ? $country->region_id . '_' . $pa_api->wdpa_id
                        : $country->iso3 . '_' . $pa_api->wdpa_id;

                    // Not found in DB: INSERT
                    if($pa===null){
                        $this->count_add++;
                        DB::table((new ProtectedArea)->getTable())
                            ->insert($attributes);

                    // Found in DB
                    } else {
                        $pa->fill($attributes);

                        // Is different: UPDATE
                        if($pa->isDirty()){
                            $this->count_update++;
                            $pa->save();
                        }

                        // No differences: nothing to do
                        else {
                            $this->count_no_change++;
                        }
                    }

                }

            }

        }

        // Job completed
        $this->info('------------------------------------------------------------');
        $this->info('Total protected areas retrieved from API: ' . $this->count_api);
        $this->info('Total protected areas UPDATED: ' .$this->count_update);
        $this->info('Total protected areas ADDED: ' .$this->count_add);
        $this->info('Total protected areas with NO CHANGES: ' .$this->count_no_change);
        $this->info('------------------------------------------------------------');

        return 0;
    }

    /**
     * Retrieve protected areas from ProtectedPlanet API
     */
    private function get_pas_by_country($country, $chunk, $per_chunk): array
    {
        $cache_msg = '';
        $chunk_msg = $chunk===1 ? '' : ' (chunk ' . $chunk . ')';
        $cache_file = $this->file_prefix . '-' . $country . '-' . $chunk . '.json';
        if(!Storage::disk(File::TEMP_STORAGE)->exists($cache_file)){
            $api_result = ProtectedPlanet::get_by_country($country, $chunk, $per_chunk);
            Storage::disk(File::TEMP_STORAGE)->put($cache_file, json_encode($api_result));
        } else {
            $api_result = json_decode(Storage::disk(File::TEMP_STORAGE)->get($cache_file));
            $cache_msg = '(from cache) ';
        }
        $this->info('  - ' . $cache_msg . count($api_result->protected_areas). ' protected areas (' . $country . ') found.' . $chunk_msg);
        return $api_result->protected_areas;
    }

    /**
     * Prepare attributes for INSERT/UPDATE
     */
    private function set_attributes($api): array
    {
        // Manage multiple countries
        $countries = count($api->countries) > 1
            ? implode(';', collect($api->countries)->pluck('iso_3')->toArray())
            : $api->countries[0]->iso_3;

        return [
            'country' => $countries,
            'wdpa_id' => $api->wdpa_id,
            'name' => str_replace("'", "''", $api->original_name),
            'iucn_category' => $api->iucn_category->name,
            'area' => (float) $api->reported_area
        ];
    }

}
