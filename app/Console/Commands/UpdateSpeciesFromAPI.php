<?php

namespace App\Console\Commands;


use AndreaMarelli\ImetCore\Models\Animal;
use App\Helpers\SpeciesUpdater;
use App\Models\Country;
use Illuminate\Console\Command;

class UpdateSpeciesFromAPI extends Command
{

    protected $signature = 'imet:update_species_from_api';

    protected $description = 'Update species from API and write CSV file for migration';

    public function handle(): int
    {
        // Update species table from DOPA API
        $this->updatePas();

        // Write CSV
        $this->writeCSV();

        return 0;
    }

    function updatePas(): void
    {
        // Retrieve countries from Protected Areas table
        $pas_countries = Country::getAll()
            ->pluck('iso3')
            ->toArray();
        $num_countries = count($pas_countries);

        // Update Protected Areas for each country
        $this->info('Updating Species for ' . $num_countries . ' countries...');
        $country_idx = 0;
        foreach ($pas_countries as $iso) {
            $this->info('Updating ' . $iso . ' (' . $country_idx . '/' . $num_countries . ')');
            SpeciesUpdater::updateByCountry($iso);
            $country_idx++;
        }

    }

    function writeCSV(): void
    {
        // Retrieve all species
        $species = Animal::all();

        // Write CSV
        $this->info('Writing CSV file...');
        $handler = fopen(database_path(SpeciesUpdater::CSV_MIGRATION_PATH), 'w');
        fputcsv($handler, SpeciesUpdater::MIGRATION_ATTRIBUTES);
        foreach ($species as $item) {
            fputcsv($handler, $item->only(SpeciesUpdater::MIGRATION_ATTRIBUTES));
        }
        fclose($handler);
    }

}
