<?php

namespace App\Jobs;


use App\Library\Utils\File\File;
use App\Models\AdministrationLevel;
use App\Models\Concession\Concession;
use App\Models\KeyLandscapeConservation;
use App\Models\Landscape;
use App\Models\ProtectedArea\ProtectedArea;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateGeoJSON implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Utils;


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
     *
     * @return void
     */
    public function handle()
    {
        try{

            //  #######  ProtectedAreas  #######
            static::log( 'Generating Protected Areas geojson...');
            $geoJSON = ProtectedArea::exportGeoJSON(
                ProtectedArea::select(['geom', 'wdpa_id as id', 'wdpa_id', 'country', 'name', 'ofac_id', 'iucn_category', 'designation', 'status'])
            );
            File::exportTo('GeoJSON','protected_areas.geojson', $geoJSON);
            static::log('done.', 'info');

            //  #######  Concessions  #######
            static::log( 'Generating Concessions geojson...');
            $geoJSON = Concession::exportGeoJSON(
                Concession::select(['geom', 'ConcessionID as id', 'Country as country', 'ConcessionName as name', 'NationalID as national_id', 'PermitType as permit_type'])
            );
            File::exportTo('GeoJSON','concessions.geojson', $geoJSON);
            static::log('done.', 'info');

            //  #######  Landscapes  #######
            static::log( 'Generating Landscapes geojson...');
            $geoJSON = Landscape::exportGeoJSON(
                    Landscape::select(['geom', 'LandscapeID as id', 'Name as name'])
            );
            File::exportTo('GeoJSON','landscapes.geojson', $geoJSON);
            static::log('done.', 'info');

            //  #######  Landscapes KLC  #######
            static::log( 'Generating Landscapes KLC geojson...');
            $geoJSON = KeyLandscapeConservation::exportGeoJSON(
                KeyLandscapeConservation::select(['geom', 'id', 'klc_id', 'klcname as name', 'region'])
            );
            File::exportTo('GeoJSON','klc.geojson', $geoJSON);
            static::log('done.', 'info');

            //  #######  countries  #######
            static::log( 'Generating countries geojson...');
            $geoJSON = \App\Models\CountryComifac::exportGeoJSON(
                \App\Models\CountryComifac::select(['geom', 'id', 'iso2', 'iso3', 'iso', 'name_fr', 'name_en', 'name_sp'])
            );
            File::exportTo('GeoJSON','countries.geojson', $geoJSON);
            static::log('done.', 'info');


        } catch (\Exception $e){
            static::log( $e->getMessage(), 'error');
        }
    }
}