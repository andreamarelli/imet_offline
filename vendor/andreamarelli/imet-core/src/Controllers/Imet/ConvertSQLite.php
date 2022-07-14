<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;


use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet_Eval;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use Illuminate\Support\Str;

trait ConvertSQLite{

    /**
     * Convert IMET
     *
     * @param $imet
     * @param $sqlite_connection
     * @return array
     */
    public static function convert($imet, $sqlite_connection): array
    {
        // skip if test
        if($imet->Country === 'AWY'){
            return [];
        }

        // Retrieve WDPAID
        [$wdpa, $pa_name] = Modules\Component\ImetModule::identifySqlitePa($imet, $sqlite_connection);

        // no WDPA nor NAME found: cannot identify
        if (empty($wdpa) && empty($pa_name)){
            return [];
        }

        // Non-WDPA protected area
        $wdpa = !empty($wdpa) ? $wdpa : ProtectedAreaNonWdpa::generate_fake_wdpa();

        // Build JSON structure
        $json = [
            "Imet" => [
                "name" => $pa_name,
                "Country" => $imet->Country,
                "Year" => $imet->Year,
                "version" => "v1",
                "wdpa_id" => trim($wdpa),
                "language" => Str::lower($imet->FormLanguage),
                "imet_version" => "SQLITE",
            ],
            "Encoders" => [],
            "Context" => [],
            "Evaluation" => [],
        ];
        if(ProtectedAreaNonWdpa::isNonWdpa($wdpa)){
            $json["NonWdpaProtectedArea"] = [];
            $json["NonWdpaProtectedArea"]['id'] = $wdpa;
            $json["NonWdpaProtectedArea"]['wdpa_id'] = trim($wdpa);
            $json["NonWdpaProtectedArea"]['name'] = $pa_name;
            $json["NonWdpaProtectedArea"]['country'] = $imet->Country;
        }

        foreach (Imet::allModules() as $module_class) {
            $json['Context'][$module_class::getShortClassName()] = $module_class::convert($imet, $sqlite_connection);
        }
        foreach (Imet_Eval::allModules() as $module_class) {
            $json['Evaluation'][$module_class::getShortClassName()] = $module_class::convert($imet, $sqlite_connection);
        }

        return $json;
    }


}
