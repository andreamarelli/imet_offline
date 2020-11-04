<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('generate_geojson', function () {
    $time_start  = microtime(true);
    \App\Jobs\GenerateGeoJSON::dispatch();
    $this->info('Finished in '.round((microtime(true) - $time_start), 2).' seconds');
})->describe('Generate GeoJSON file of vectorial entities in the DB');


Artisan::command('parse_protected_planet_csv', function () {
    \App\Jobs\ParseProtectedPlanetCSV::dispatch();
})->describe(\App\Jobs\ParseProtectedPlanetCSV::description);

Artisan::command('populate_imet_species {--imet_offline}', function () {
    \App\Jobs\PopulateIMETSpecies::dispatch();
})->describe(\App\Jobs\PopulateIMETSpecies::description);

