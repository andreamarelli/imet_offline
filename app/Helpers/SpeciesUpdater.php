<?php

namespace App\Helpers;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ModularForms\Helpers\API\DOPA\DOPA;
use AndreaMarelli\ModularForms\Helpers\File\File;
use App\Models\Country;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpeciesUpdater
{

    public const MIGRATION_ATTRIBUTES = ['kingdom', 'phylum', 'class', 'order', 'family', 'genus', 'species', 'iucn_redlist_id', 'iucn_redlist_category', 'common_name_en', 'common_name_fr', 'common_name_sp', 'country_distribution'];
    public const CSV_MIGRATION_PATH = 'species.csv';
    public const CSV_NAMES_PATH = 'species_names.csv';

    public static function updateByCountry(Country|string $country): void
    {
        $country = is_string($country) ? Country::find($country) : $country;

        // Retrieve species from API
        $species_API = self::getFromApi($country->iso3);
        $attributes = static::getAPIAttributes($species_API);

        // Update species table with upsert
        if(count($attributes)>0){
            Animal::upsert($attributes,
                ['order', 'family', 'genus', 'species'],
                array_keys($attributes[0])
            );
        }

    }

    private static function getFromApi($country): array
    {
        $cache_msg = '';
        $cache_file = date("Y-m").'_species_'.$country.'.json';

        // Retrieve from API
        if(!Storage::disk(File::TEMP_STORAGE)->exists($cache_file)){
            $api_result = DOPA::get_country_redlist_th_list($country);
            Storage::disk(File::TEMP_STORAGE)->put($cache_file, json_encode($api_result));
        }
        // Retrieve from cache
        else {
            $api_result = json_decode(Storage::disk(File::TEMP_STORAGE)->get($cache_file));
            $cache_msg = '(cached) ';
        }

        $api_result = json_decode(json_encode($api_result), true);

        Log::info('Retrieved ' . $cache_msg  . ' ' . count($api_result) . ' species from DOPA API (' . $country . ').');
        return $api_result;
    }

    /**
     * Prepare attributes for INSERT/UPDATE
     */
    private static function getAPIAttributes($api): array
    {
        // Retrieve common names from CSV
        $common_names = static::retrieveCommonNamesFromCSV();

        // Retrieve common names and country distribution from DB
        $species_DB = Animal::select(['iucn_redlist_id', 'common_name_en', 'common_name_fr', 'common_name_sp', 'country_distribution'])
            ->get()
            ->keyBy('iucn_redlist_id');

        $attributes = [];
        foreach ($api as $api_item) {
            list($genus, $species) = explode(' ', $api_item['binomial']);
            $attributes[] = [
                'genus' => $genus,
                'species' => $species,
                'family' => $api_item['family'],
                'order' => $api_item['order'],
                'class' => $api_item['class'],
                'phylum' => $api_item['phylum'],
                'kingdom' => $api_item['kingdom'],
                'iucn_redlist_id' => $api_item['id_no'],
                'iucn_redlist_category' => $api_item['code'],
                'common_name_en' => self::mergeCommonNames($species_DB[$api_item['id_no']]->common_name_en ?? null, $common_names[$api_item['id_no']]['en'] ?? null),
                'common_name_fr' => self::mergeCommonNames($species_DB[$api_item['id_no']]->common_name_fr ?? null, $common_names[$api_item['id_no']]['fr'] ?? null),
                'common_name_sp' => self::mergeCommonNames($species_DB[$api_item['id_no']]->common_name_sp ?? null, $common_names[$api_item['id_no']]['sp'] ?? null),
                'country_distribution' => static::mergeCountryDistribution($species_DB[$api_item['id_no']]->country_distribution ?? null, $api_item['iso3_country'])
            ];
        }

        return $attributes;
    }

    private static function retrieveCommonNamesFromCSV(): array
    {
        $csv_file = file(database_path(self::CSV_NAMES_PATH));
        $common_names = [];
        foreach ($csv_file as $csv_line){
            $line = str_getcsv($csv_line,  '|');
            $common_names[$line[0]] = [
                'en' => $line[24],
                'fr' => $line[31],
                'sp' => $line[97],
            ];
        }
        return $common_names;
    }


    private static function mergeCommonNames($from_db, $from_csv): ?string
    {
        $from_db = ($from_db === null or $from_db === '') ? [] : explode(',', $from_db);
        $from_csv = ($from_csv === null or $from_csv === '') ? [] : explode(',', $from_csv);
        $from_csv = collect($from_csv)
            ->filter(function($name){
                return $name !== '' and $name !== null and $name !== 'NULL';
            })
            ->map(function($name){
                return ucwords(Str::lower($name));
            })
            ->toArray();
        $merged = array_merge($from_db, $from_csv);
        $merged = array_unique($merged);
        if(count($merged)>0){
            return implode(',', $merged);
        }
        return null;
    }

    private static function mergeCountryDistribution($from_db, $iso3): string
    {
        $countries = ($from_db == null or $from_db == '') ? [] : json_decode($from_db);
        if (!in_array($iso3, $countries)) {
            $countries[] = $iso3;
        }
        return json_encode($countries);
    }


}
