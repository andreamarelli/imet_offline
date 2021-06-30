<?php

namespace App\Http\Controllers\Imet\ScalingUp;

use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;
use App\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;

trait ScalingUpAnalysis
{

    private $ttl = 1;
    private $protected_areas_ids = [];

    /** 
     * @param Request $request
     * @return array
     */
    public function get_ajax_responses(Request $request)
    {
        $action = $request->input('func');
        $parameters = $request->input('parameter');
        return ModelScalingUpAnalysis::$action($parameters);

    }


    /**
     * @param $items
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function report_scaling_up($items)
    {
        $scaling_up_id = null;
        $areas = '';
        $item = ModelScalingUpAnalysis::get_scaling_up_by_wdpas($items);
        if ($item->count() === 0) {
            $item = ModelScalingUpAnalysis::create(["wdpas" => $items]);

            if (isset($item)) {
                $areas = $item['wdpas'];
                $scaling_up_id = $item['id'];
            }
        } else {
            $areas = $item[0]['wdpas'];
            $scaling_up_id = $item[0]['id'];
        }


        $protected_areas = ModelScalingUpAnalysis::get_protected_area(explode(',', $areas));
        $areas_names = [];
        foreach ($protected_areas as $k => $protected_area) {
            $areas_names[$k] = $protected_area->name;
        }

        asort($areas_names);
        $pa_ids = implode(',', array_keys($areas_names));

        $areas_names_concat = implode(', ', $areas_names);
//trans('form/imet/v1/evaluation.ClimateChangeMonitoring.fields.Program')
        //'grouping-action-buttons,start-zone,dropzone-areas,render-buttons'
        $templates_names = [
            ['name' => "map_view", 'title' => 'Map from Dopa Explorer', 'snapshot_id' => "map_view", 'exclude_elements' => ''],
            ['name' => "general_elements", 'title' => 'General elements of the protected areas', 'snapshot_id' => "general_elements", 'exclude_elements' => ''],

            ['name' => "management_context", 'title' => 'Management context (key elements of management)', 'snapshot_id' => "management_context", 'exclude_elements' => ''],
            ['name' => "threats_categories", 'title' => 'Threats Categories', 'snapshot_id' => "management_context", 'exclude_elements' => ''],

            ['name' => "evaluation_of_protected_area_management_cycle", 'title' => 'Management effectiveness', 'snapshot_id' => "evaluation_of_protected_area_management_cycle", 'exclude_elements' => ''],
            ['name' => "elements_diagrams", 'title' => 'Protected areas compared for the elements of management cycle', 'snapshot_id' => "elements_diagrams", 'exclude_elements' => ''],
            ['name' => "performance_diagram", 'title' => 'Performance in 6 elements of the management effectiveness cycle', 'snapshot_id' => "performance_diagram", 'exclude_elements' => ''],
            ['name' => "relative_performance_effectiveness_bar_average", 'title' => 'Averages of the six elements of management effectiveness for all protected area intervals', 'snapshot_id' => "relative_performance_effectiveness_bar_average", 'exclude_elements' => ''],
            ['name' => "imet_ranking", 'title' => 'Imet Ranking', 'snapshot_id' => "relative_performance_effectiveness_intervals", 'exclude_elements' => ''],
            ['name' => "relative_performance_effectiveness_intervals", 'title' => 'Confidence intervals per protected area', 'snapshot_id' => "relative_performance_effectiveness_intervals", 'exclude_elements' => 'smallMenu'],

            ['name' => "management_effectiveness_analysis", 'title' => 'Averages of the six elements of management effectiveness for all protected area intervals', 'snapshot_id' => "management_effectiveness_analysis", 'exclude_elements' => ''],
            ['name' => "specific_actions_mention", 'title' => 'Specific actions to mention because they affect the analysis', 'snapshot_id' => "specific_actions_mention", 'exclude_elements' => ''],
            ['name' => "total_carbon", 'title' => 'Total carbon', 'snapshot_id' => "total_carbon", 'exclude_elements' => ''],
            ['name' => 'grouping_analysis_on_demand', 'title' => 'Grouping', 'snapshot_id' => "grouping_analysis_on_demand", 'exclude_elements' => 'js-grouping-action-buttons,start-zone,js-render-buttons'],
            ['name' => "terestial_ecoregions", 'title' => 'Terestial ecoregions', 'snapshot_id' => "terestial_ecoregions", 'exclude_elements' => ''],
            ['name' => "marine_ecoregions", 'title' => 'Marine ecoregions', 'snapshot_id' => "marine_ecoregions", 'exclude_elements' => ''],
            ['name' => "copernicus", 'title' => 'Copernicus Global Land Cover', 'snapshot_id' => "copernicus", 'exclude_elements' => ''],
            ['name' => "protected_area_table", 'title' => 'List of protected areas >= 10m2 and associated pressures', 'snapshot_id' => "protected_area_table", 'exclude_elements' => ''],

            ['name' => "protected_area_coverage_and_connectivity", 'title' => 'Protected area coverage and connectivity', 'snapshot_id' => "protected_area_coverage_and_connectivity", 'exclude_elements' => ''],
            ['name' => "land_degradation", 'title' => 'Land degradation', 'snapshot_id' => "land_degradation", 'exclude_elements' => ''],

        ];

        return view('admin.imet.scaling_up.report', [
            'templates' => $templates_names,
            'pa_ids' => $pa_ids,
            'protected_areas' => $areas_names_concat,
            'scaling_up_id' => $scaling_up_id
        ]);
    }

    public function preview_template(int $id)
    {
        $areas_names_concat = "";
        $records = ModelScalingUpAnalysis::where('id', $id)->get();

        if (count($records) > 0) {
            $protected_areas = ModelScalingUpAnalysis::get_protected_area(explode(',', $records[0]->wdpas));
            foreach ($protected_areas as $k => $protected_area) {
                $areas_names[$k] = $protected_area->name;
            }

            asort($areas_names);

            $areas_names_concat = implode(', ', $areas_names);
        }

        return view('admin.imet.scaling_up.preview_template', [
            "scaling_up_id" => $id,
            'protected_areas' => $areas_names_concat
        ]);
    }

}