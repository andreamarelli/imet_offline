<?php

namespace AndreaMarelli\ModularForms\Helpers\API\DOPA;


trait Wdpa
{

    /**
     * Returns all indicators for pa
     *
     * @param $wdpa
     * @return mixed
     */
    public static function get_wdpa_all_inds($wdpa)
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/protected_sites/get_wdpa_all_inds', [
            'format' => 'json',
            'wdpaid' => $wdpa
        ]);
    }

    /**
     * Returns Terrestrial and Marine Ecoregions in Protected Area.
     *
     * @param $wdpa
     * @return mixed
     */
    public static function get_pa_ecoregions($wdpa)
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/habitats_and_biotopes/get_pa_ecoregions', [
                    'format' => 'json',
                    'wdpaid' => $wdpa
        ]);
    }

    /**
     * For a given WDPA, returns absolute cover of ESA LC CCI classes (aggregated by level 1: 4 classes) which changed
     * within first and last epoch.
     *
     * @param $wdpa
     * @return mixed
     */
    public static function get_wdpa_lcc_esa($wdpa)
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/landcover/get_wdpa_lcc_esa', [
                    'format' => 'json',
                    'wdpaid' => $wdpa
        ]);
    }

    /**
     * Returns climate data (prec, tmin, tmax, tmean) for a protected site, using wdpaid of protected area from WCMC
     * ProtectedPlanet.org website: the climate data type, e.g. prec for precipitation; The unit of measure for the
     * values; Average value for all months.
     *
     * @param $wdpa
     * @return mixed
     */
    public static function get_worldclim_pa($wdpa)      // deprecated: to be replaced with d6dopa40/protected_sites/get_wdpa_all_inds
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/climate/get_worldclim_pa', [
                    'format' => 'json',
                    'wdpaid' => $wdpa
        ]);
    }

    /**
     * Returns statistics (counts species, by class, by IUCN categories) for species (Corals, Sharks & Rays, Amphibians,
     * Birds, Mammals) in Protected Area; calculated as intersection of species ranges with WDPA
     *
     * @param $wdpa
     * @return mixed
     */
    public static function get_pa_redlist_status($wdpa)
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/species/get_pa_redlist_status', [
                    'format' => 'json',
                    'wdpaid' => $wdpa
        ]);
    }

    /**
     * Returns list of species (Corals, Sharks & Rays, Amphibians, Birds, Mammals) in Protected Area; calculated as
     * intersection of species ranges with WDPA
     *
     * @param $wdpa
     * @return mixed
     */
    public static function get_pa_redlist_list($wdpa)
    {
        return self::request(self::URL_PREFIX . 'd6dopa40/species/get_pa_redlist_list', [
                    'format' => 'json',
                    'wdpaid' => $wdpa
        ]);
    }

    /**
     * Returns Terrestrial/Marine Habitat Diversity
     *
     * For terrestrial protected areas as merged services from: protected_sites.wdpa, hdi.get_thdi_country_pa(),
     * protected_sites.wdpa_all_normalized_pressures, species.get_country_pa_redlist_indicator()
     *
     * For marine protected areas as merged services from: protected_sites.wdpa, species.get_country_pa_redlist_indicator(),
     * topography.get_marine_hdi_pa();
     *
     * @param $wdpa
     * @param bool $terrestrial
     * @param int $on_error
     * @return mixed
     *
     */
    public static function get_wdpa_radarplot($wdpa, bool $terrestrial = true, int $on_error = DOPA::ON_ERROR_RESPONSE)
    {
        $url = $terrestrial
            ? 'd6dopa40/protected_sites/get_wdpa_terrestrial_radarplot'
            : 'd6dopa40/protected_sites/get_wdpa_marine_radarplot';
        return self::request(self::URL_PREFIX . $url, [
            'format' => 'json',
            'wdpaid' => $wdpa
        ], $on_error);
    }

    /**
     * Returns the copernicus Global Landcover
     *
     * @param $wdpa
     * @return mixed
     */
    public static function get_wdpa_lc_copernicus($wdpa){
         return self::request(self::URL_PREFIX . 'd6dopa40/landcover/get_wdpa_lc_copernicus', [
            'format' => 'json',
             'wdpaid' => $wdpa,
            'agg' => 2,
            'year' => 2015
        ]);
    }

    /**
     * Returns Terrestrial and Marine Ecoregions in Protected Area.
     *
     * @param $wdpa
     * @return array
     */
    public static function get_wdpa_ecoregions($wdpa)
    {
        return self::request(self::URL_PREFIX . 'd6dopa/dopa_41/get_dopa_ecoregion_pa', [
            'format' => 'json',
            'wdpaid' => $wdpa
        ]);
    }

    /**
    * Returns the copernicus Global Landcover for wdpa
     *
    * @param $wdpa
    * @return array
    */
    public static function get_wdpa_copernicus($wdpa){
        return self::request(self::URL_PREFIX . 'd6dopa/dopa_41/get_dopa_wdpa_lc_copernicus', [
            'format' => 'json',
            'wdpaid' => $wdpa,
            'agg' => 2,
            'year' => 2015
        ]);
    }

}
