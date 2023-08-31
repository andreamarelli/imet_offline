<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp;


use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis;
use Illuminate\Support\Facades\App;

trait GeneralInfo
{
    /**
     * @param array $parameters
     * @param string $language
     * @return array
     * @throws \ReflectionException
     */
    public static function get_general_info(array $parameters, string $language = 'en'): array
    {
        $labels = [
            'network' => trans('imet-core::analysis_report.general_info.network'),
            'countries' => trans('imet-core::analysis_report.general_info.country'),
            'eco_regions' => trans('imet-core::analysis_report.general_info.ecoregions'),
            'total_surface_protected_areas' => trans('imet-core::analysis_report.general_info.total_surface_protected'),
            'local_mission' => trans('imet-core::analysis_report.general_info.mission'),
            'local_objective' => trans('imet-core::analysis_report.general_info.objectives'),
            'local_vision' => trans('imet-core::analysis_report.general_info.vision')
        ];

        $api = ScalingUpAnalysis::general_info($parameters);

        return ['data' => $api['data']['general_info'], 'labels' => $labels];
    }


}
