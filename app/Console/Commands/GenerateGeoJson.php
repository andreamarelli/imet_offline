<?php

namespace App\Console\Commands;

use App\Library\Utils\File\File;
use App\Models\Concession\Concession;
use App\Models\KeyLandscapeConservation;
use App\Models\Landscape;
use App\Models\ProtectedArea\ProtectedArea;
use Illuminate\Console\Command;

class GenerateGeoJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:geojson';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate GeoJSON file of vectorial entities in the DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{

            //  #######  ProtectedAreas  #######
            $this->line( 'Generating Protected Areas geojson...');
            $geoJSON = ProtectedArea::exportGeoJSON(
                ProtectedArea::select(['geom', 'wdpa_id as id', 'wdpa_id', 'country', 'name', 'ofac_id', 'iucn_category', 'designation', 'status'])
            );
            File::exportTo('GeoJSON','protected_areas.geojson', $geoJSON);
            $this->info('done.');

            //  #######  Concessions  #######
            $this->line( 'Generating Concessions geojson...');
            $geoJSON = Concession::exportGeoJSON(
                Concession::select(['geom', 'ConcessionID as id', 'Country as country', 'ConcessionName as name', 'NationalID as national_id', 'PermitType as permit_type'])
            );
            File::exportTo('GeoJSON','concessions.geojson', $geoJSON);
            $this->info('done.');

            //  #######  Landscapes  #######
            $this->line( 'Generating Landscapes geojson...');
            $geoJSON = Landscape::exportGeoJSON(
                Landscape::select(['geom', 'LandscapeID as id', 'Name as name'])
            );
            File::exportTo('GeoJSON','landscapes.geojson', $geoJSON);
            $this->info('done.');

            //  #######  Landscapes KLC  #######
            $this->line( 'Generating Landscapes KLC geojson...');
            $geoJSON = KeyLandscapeConservation::exportGeoJSON(
                KeyLandscapeConservation::select(['geom', 'id', 'klc_id', 'klcname as name', 'region'])
            );
            File::exportTo('GeoJSON','klc.geojson', $geoJSON);
            $this->info('done.');

            //  #######  countries  #######
            $this->line( 'Generating countries geojson...');
            $geoJSON = \App\Models\CountryComifac::exportGeoJSON(
                \App\Models\CountryComifac::select(['geom', 'id', 'iso2', 'iso3', 'iso', 'name_fr', 'name_en', 'name_sp'])
            );
            File::exportTo('GeoJSON','countries.geojson', $geoJSON);
            $this->info('done.');


        } catch (\Exception $e){
            $this->error($e->getMessage());
        }
        return 0;
    }
}
