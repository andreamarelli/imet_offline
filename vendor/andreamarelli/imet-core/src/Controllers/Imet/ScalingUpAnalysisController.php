<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Basket;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
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
        ModelScalingUpAnalysis::$scaling_id = $request->input(('scaling_id'));

        return ModelScalingUpAnalysis::$action($parameters);
    }

    /**
     * @param $scaling_up_id
     * @param $areas
     */
    private function save_default_names($scaling_up_id, $areas)
    {
        $isScalingUpInit = ScalingUpWdpa::retrieve_by_scaling_id($scaling_up_id);
        if (count($isScalingUpInit) === 0) {
            ModelScalingUpAnalysis::reset_areas_ids();
            ScalingUpWdpa::save_pas($scaling_up_id, $areas);
        }
    }

    /**
     * @param $scaling_up_id
     * @return array
     */
    private function retrieve_custom_names($scaling_up_id): array
    {
        $custom_names = [];
        $items = ScalingUpWdpa::retrieve_by_scaling_id($scaling_up_id);
        foreach ($items as $item) {
            $custom_names[$item->FormID] = $item->name;
        }
        return $custom_names;
    }

    /**
     * @param Request $request
     * @param $items
     * @param $scaling_up_id
     */
    private function update_custom_names(Request $request, $items, $scaling_up_id)
    {
        $ids = explode(',', $items);
        foreach ($ids as $id) {
            if ($request->input($id)) {
                ScalingUpWdpa::update_item($scaling_up_id, $id, $request->input($id));
            }
        }
    }

    /**
     * @param Request $request
     * @param null $items
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    /**
     * @param Request $request
     * @param null $items
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function report_scaling_up(Request $request, $items = null)
    {
        $scaling_up_id = null;
        $areas = '';

        //create an  array with the pa ids sorted and then return it as a string
        $items_array = explode(',', $items);
        sort($items_array);


        //check if the parameters are an array of numbers and pa exist in the db
        $filtered_array = array_filter($items_array, function ($value) {
            if (is_numeric($value)) {
                if (Imet::where('FormID', $value)->count() === 0) {
                    return false;
                }
            }else{
                return false;
            }

            return true;
        });

        // if not return 404
        if (count($items_array) === 0 || (count($filtered_array) !== count($items_array))) {
            abort(404);
        }

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


        $protected_areas = ModelScalingUpAnalysis::get_protected_area(explode(',', $areas), true);

        if ($request->input("save_form")) {
            ModelScalingUpAnalysis::reset_areas_ids();
            $this->update_custom_names($request, $items, $scaling_up_id);
        }

        $isScalingUpInit = ScalingUpWdpa::retrieve_by_scaling_id($scaling_up_id);
        // set custom names for all the pa's
        if (count($isScalingUpInit) === 0) {
            $this->save_default_names($scaling_up_id, $protected_areas);
        }

        $pa_ids = implode(',', array_keys($protected_areas));
        $custom_names = $this->retrieve_custom_names($scaling_up_id);
        $protected_areas_names = implode(', ', $custom_names);

        $templates_names = [
            ['name' => "map_view", 'title' => trans('imet-core::analysis_report.sections.first'), 'snapshot_id' => "map_view", 'exclude_elements' => ''],
            ['name' => "general_elements", 'title' => trans('imet-core::analysis_report.sections.second'), 'snapshot_id' => "general_elements", 'exclude_elements' => ''],
            ['name' => "key_elements_of_conservation", 'title' => trans('imet-core::analysis_report.sections.third'), 'snapshot_id' => "management_context", 'exclude_elements' => ''],
            ['name' => "overall_management_effectiveness_scores", 'title' => trans('imet-core::analysis_report.sections.fourth'), 'snapshot_id' => "evaluation_of_protected_area_management_cycle", 'exclude_elements' => ''],
            ['name' => 'grouping_analysis_on_demand', 'title' => trans('imet-core::analysis_report.sections.fifth'), 'snapshot_id' => "grouping_analysis_on_demand", 'exclude_elements' => 'js-grouping-action-buttons,start-zone,js-render-buttons'],
            ['name' => "analysis_per_element_of_them_management_cycle", 'title' => trans('imet-core::analysis_report.sections.sixth'), 'snapshot_id' => "elements_diagrams", 'exclude_elements' => ''],
            ['name' => "relative_performance_effectiveness_intervals", 'title' => trans('imet-core::analysis_report.sections.seventh'), 'snapshot_id' => "relative_performance_effectiveness_intervals", 'exclude_elements' => 'smallMenu'],
            ['name' => "additional_option_digital_information_per_pa", 'title' => trans('imet-core::analysis_report.sections.eighth'), 'snapshot_id' => "additional_option_digital_information_per_pa", 'exclude_elements' => ''],
        ];

        return view('imet-core::scaling_up.report', [
            'templates' => $templates_names,
            'pa_ids' => $pa_ids,
            'protected_areas_names' => $protected_areas_names,
            'scaling_up_id' => $scaling_up_id,
            'protected_areas' => $protected_areas,
            'custom_names' => $custom_names,
            'request' => $request
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
            return trans("imet-core::analysis_report.more_than_one_file");
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function preview_template(int $id)
    {
        $areas_names_concat = "";
        $records = ModelScalingUpAnalysis::where('id', $id)->get();
        ModelScalingUpAnalysis::$scaling_id = $id;
        if (count($records) > 0) {
            $protected_areas = ModelScalingUpAnalysis::get_array_of_custom_names(explode(',', $records[0]->wdpas));
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
