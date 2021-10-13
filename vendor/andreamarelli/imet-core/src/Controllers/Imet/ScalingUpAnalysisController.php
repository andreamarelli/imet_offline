<?php
namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Basket;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ModularForms\Helpers\File\Compress;
use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScalingUpAnalysisController
{

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
            if(is_object($protected_area)) {
                $areas_names[$k] = $protected_area->name;
            }
        }

        asort($areas_names);
        $pa_ids = implode(',', array_keys($areas_names));

        $areas_names_concat = implode(', ', $areas_names);

        $templates_names = [
            ['name' => "map_view", 'title' => 'Location of selected PAs', 'snapshot_id' => "map_view", 'exclude_elements' => ''],
            ['name' => "general_elements", 'title' => 'General elements of the protected areas', 'snapshot_id' => "general_elements", 'exclude_elements' => ''],

            ['name' => "management_context", 'title' => 'Management context (key elements of management)', 'snapshot_id' => "management_context", 'exclude_elements' => ''],
            ['name' => "threats_categories", 'title' => 'Threats Categories', 'snapshot_id' => "management_context", 'exclude_elements' => ''],

            ['name' => "evaluation_of_protected_area_management_cycle", 'title' => 'Management effectiveness', 'snapshot_id' => "evaluation_of_protected_area_management_cycle", 'exclude_elements' => ''],
            ['name' => "elements_diagrams", 'title' => 'Protected areas compared for the elements of management cycle', 'snapshot_id' => "elements_diagrams", 'exclude_elements' => ''],
            ['name' => "performance_diagram", 'title' => 'Performance in 6 elements of the management effectiveness cycle', 'snapshot_id' => "performance_diagram", 'exclude_elements' => ''],
            ['name' => "relative_performance_effectiveness_bar_average", 'title' => 'Averages of the six elements of management effectiveness for all protected area intervals', 'snapshot_id' => "relative_performance_effectiveness_bar_average", 'exclude_elements' => ''],
            ['name' => "imet_ranking", 'title' => 'Imet Ranking', 'snapshot_id' => "relative_performance_effectiveness_intervals", 'exclude_elements' => ''],
            ['name' => "relative_performance_effectiveness_intervals", 'title' => 'Confidence intervals per protected area', 'snapshot_id' => "relative_performance_effectiveness_intervals", 'exclude_elements' => 'smallMenu'],

            ['name' => "management_effectiveness_analysis", 'title' => 'Management effectiveness analysis', 'snapshot_id' => "management_effectiveness_analysis", 'exclude_elements' => ''],
            ['name' => "specific_actions_mention", 'title' => 'Summary of key elements affecting the management elements', 'snapshot_id' => "specific_actions_mention", 'exclude_elements' => ''],
            ['name' => "total_carbon", 'title' => 'Total carbon', 'snapshot_id' => "total_carbon", 'exclude_elements' => ''],
            ['name' => 'grouping_analysis_on_demand', 'title' => 'Grouping', 'snapshot_id' => "grouping_analysis_on_demand", 'exclude_elements' => 'js-grouping-action-buttons,start-zone,js-render-buttons'],
            ['name' => "terestial_ecoregions", 'title' => 'Terestial ecoregions', 'snapshot_id' => "terestial_ecoregions", 'exclude_elements' => ''],
            ['name' => "marine_ecoregions", 'title' => 'Marine ecoregions', 'snapshot_id' => "marine_ecoregions", 'exclude_elements' => ''],
            ['name' => "copernicus", 'title' => 'Copernicus Global Land Cover', 'snapshot_id' => "copernicus", 'exclude_elements' => ''],
            ['name' => "forest_cover", 'title' => 'Forest cover', 'snapshot_id' => "forest_cover", 'exclude_elements' => ''],

            ['name' => "protected_area_coverage_and_connectivity", 'title' => 'Protected area coverage and connectivity', 'snapshot_id' => "protected_area_coverage_and_connectivity", 'exclude_elements' => ''],
            ['name' => "land_degradation", 'title' => 'Land degradation', 'snapshot_id' => "land_degradation", 'exclude_elements' => ''],

        ];

        return view('imet-core::scaling_up.report', [
            'templates' => $templates_names,
            'pa_ids' => $pa_ids,
            'protected_areas' => $areas_names_concat,
            'scaling_up_id' => $scaling_up_id
        ]);
    }

    /**
     * export scaling up images in zip file
    * @param int $scaling_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|string
     */
    public function download_zip_file(int $scaling_id)
    {
        $files = [];
        $scaling_up = Basket::where('scaling_up_id', $scaling_id)->get();
        foreach ($scaling_up as $record) {
            $files[] = Storage::disk(File::PUBLIC_FOLDER)->path('') . $record->item;
        }

        if (count($files) > 1) {
            $path = Compress::zipFile($files, "Scaling_up", false);
            return File::download($path);
        } else {
            return "";
        }
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

        return view('imet-core::scaling_up.preview_template', [
            "scaling_up_id" => $id,
            'protected_areas' => $areas_names_concat
        ]);
    }

}
