<?php

namespace AndreaMarelli\ModularForms\Helpers\API\DOPA;


trait Country{

    /**
     * Returns the Protected Area core statistics for all Protected Areas for a specific country
     * Documentation: https://rest-services.jrc.ec.europa.eu/services/d6dopa40/administrative_units/get_country_pa_stats
     * @param $country
     * @return mixed
     */
    public static function get_country_pa_stats($country = null)
    {
        return self::request(self::URL_PREFIX.'d6dopa40/administrative_units/get_country_pa_stats', [
            'format' => 'json',
            'a_iso3' => $country
        ]);
    }

    /**
     * Returns list of species (Corals, Sharks & Rays, Amphibians, Birds, Mammals) in country protected; calculated with
     * the returning iso3 of intersection within species ranges and WDPA
     *
     * @param $country
     * @return mixed
     */
    public static function get_country_redlist_th_list($country)
    {
        return self::request(self::URL_PREFIX.'d6dopa40/species/get_country_redlist_th_list', [
            'format' => 'json',
            'a_iso3' => $country,
        ]);
    }

    public static function get_country_species_total($country = null)
    {
        return self::request(self::URL_PREFIX.'d6dopa40/species/get_country_species_total', [
            'format' => 'json',
            'a_iso3' => $country
        ]);
    }

    public static function get_country_threatened_animals($country = null)
    {
        return self::request(self::URL_PREFIX.'d6dopa40/species/get_country_threatened_animals', [
            'format' => 'json',
            'a_iso3' => $country
        ]);
    }

    public static function get_country_endemics_threatened_vertebrates($country = null)
    {
        return self::request(self::URL_PREFIX.'d6dopa40/species/get_country_endemics_threatened_vertebrates', [
            'format' => 'json',
            'a_iso3' => $country
        ]);
    }

    public static function get_country_all_inds($country = null)
    {
        $params['format'] = 'json';
        if ($country!==null) {
            $params['a_iso3'] = $country;
        }
        return self::request(self::URL_PREFIX . 'd6dopa40/administrative_units/get_country_all_inds?', $params);
    }

    public static function get_country_pa_normalized_indicator($country = null)
    {
        return self::request(self::URL_PREFIX.'d6dopa40/administrative_units/get_country_pa_normalized_indicator', [
            'format' => 'json',
            'iso' => $country,
            'indicator' => 'agri_ind_pa'
        ]);
    }

    public static function get_country_pa_normalized_indicator_marine($country)
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/administrative_units/get_country_pa_normalized_indicator', [
            'format' => 'json',
            'indicator' => 'mhdi',
            'iso' => $country,
        ]);
    }

    public static function get_country_ecoregions_stats($country)
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/administrative_units/get_country_ecoregions_stats', [
            'format' => 'json',
            'a_iso3' => $country,
        ]);
    }

    public static function get_country_lc_copernicus($country)
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/landcover/get_country_lc_copernicus', [
            'format' => 'json',
            'iso' => 'iso3',
            'country' => $country,
            'agg' => 2,
            'year' => 2015
        ]);
    }

    public static function get_country_lcc_esa($country)
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/landcover/get_country_lcc_esa', [
            'format' => 'json',
            'iso' => 'iso3',
            'country' => $country,
        ]);
    }
}
