<?php

namespace AndreaMarelli\ImetCore\Helpers\API\DOPA;

use AndreaMarelli\ModularForms\Helpers\API\DOPA\Wdpa as BaseWdpa;

trait Wdpa
{
    use BaseWdpa;

   /**
   * Returns the copernicus Global Landcover for wdpa
   * @param $wdpa
   * @return array
   */
    public static function get_wdpa_copernicus($wdpa): object
    {
         return self::request(self::API_URL . 'd6dopa/dopa_41/get_de_wdpa_lc_copernicus', [
            'format' => 'json',
            'wdpaid' => $wdpa,
            'agg' => 2
        ]);
    }

    /**
     * Returns all indicators for pa
     *
     * @param $wdpa
     * @return array
     */
    public static function get_de_wdpa_all_inds($wdpa): object
    {
        return self::request(self::API_URL . 'd6dopa/dopa_41/get_de_wdpa_all_inds', [
            'format' => 'json',
            'wdpaid' => $wdpa
        ]);
    }

}
