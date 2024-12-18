<?php

namespace App\Console\Commands;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Exceptions\MissingAPITokenException;
use App\Helpers\ProtectedAreaUpdater;
use App\Models\ProtectedAreaUpdate;
use App\Models\Settings;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class AddCountriesProtectedAreasFromAPI extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'imet:add_countries_pas_from_api {country}';

    /**
     * The console command description.
     */
    protected $description = 'Add the given countries\' Protected Areas from Protected Planet API and append to CSV file for migration';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Config::set('PROTECTED_PLANET_API_KEY', Settings::getSetting('protected_planet_api_key'));

        $countries = $this->argument('country');
        $countries = explode(',', $countries);

        // Retrieve given countries Protected Areas
        foreach ($countries as $country) {
            $this->retrieveCountryPas($country);
        }

        // Write CSV
        $this->writeCSV();

        $this->info('Done');

        return 0;
    }

    function retrieveCountryPas($country): void
    {
        try {
            $this->info('Retrieving Protected Areas for ' . $country . '...');
            ProtectedAreaUpdater::updateByCountry($country);     // Update Protected Areas for a country
            ProtectedAreaUpdate::setUpdated($country);      // Update last update date

        } catch (MissingAPITokenException $e) {
            $this->error('Missing API token for Protected Planet');
        }


    }

    function writeCSV(): void
    {
        // Retrieve all Protected Areas
        $pas = ProtectedArea::all();

        // Write CSV
        $this->info('Writing CSV file...');
        $handler = fopen(database_path(ProtectedAreaUpdater::CSV_MIGRATION_PATH), 'w');
        fputcsv($handler, ProtectedAreaUpdater::MIGRATION_ATTRIBUTES);   // header
        foreach ($pas as $pa) {
            fputcsv($handler, $pa->only(ProtectedAreaUpdater::MIGRATION_ATTRIBUTES));
        }
        fclose($handler);
    }


}
