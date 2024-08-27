<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\__Controller;
use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Basket;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis as ModelScalingUpAnalysis;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ModularForms\Helpers\File\Zip;
use AndreaMarelli\ModularForms\Helpers\HTTP;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;


class ScalingUpAnalysisController extends __Controller
{
    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::';

    protected const PAGINATE = false;

    public const sanitization_rules = [
        'search' => 'custom_text|nullable',
        'year' => 'digits:4|integer|nullable',
        'country' => 'min:3|max:3|alpha|nullable',
    ];

    private $indicators = [
        'context' => [
            'C1' => [],
            'C2' => [],
            'C3' => []
        ],
        'context_value_and_importance' => [
            'C11' => [],
            'C12' => [],
            'C13' => [],
            'C14' => [],
            'C15' => []
        ],
        'planning' => [
            'P1' => [],
            'P2' => [],
            'P3' => [],
            'P4' => [],
            'P5' => [],
            'P6' => []
        ],
        'inputs' => [
            'I1' => [],
            'I2' => [],
            'I3' => [],
            'I4' => [],
            'I5' => []
        ],
        'process' => [],
        'process_sub_indicators' => [
            'PRE' => [],
            'PRC' => [],
            'PRD' => [],
            'PRF' => [],
            'PRA' => [],
            'PRB' => [],
        ],
        'process_internal_management' => [
            'PR1' => [],
            'PR2' => [],
            'PR3' => [],
            'PR4' => [],
            'PR5' => [],
            'PR6' => [],
        ],
        'process_PRB' => [
            'PR7' => [],
            'PR8' => [],
            'PR9' => []
        ],
        'process_PRC' => [
            'PR10' => [],
            'PR11' => [],
            'PR12' => []
        ],
        'process_PRD' => [
            'PR13' => [],
            'PR14' => []
        ],
        'process_PRE' => [
            'PR15' => [],
            'PR16' => []
        ],
        'process_PRF' => [
            'PR17' => [],
            'PR18' => []
        ],
        'outputs' => [
            'OP1' => [],
            'OP2' => [],
            'OP3' => []
        ],
        'outcomes' => [
            'OC1' => [],
            'OC2' => [],
            'OC3' => []
        ]
    ];

    /**
     * Index route for scaling up
     *
     * @throws AuthorizationException
     */
    public function index(Request $request): Application|View|Factory
    {
        HTTP::sanitize($request, self::sanitization_rules);

        // set filter status
        $filter_selected = !empty(array_filter($request->except('_token')));

        // retrieve IMET list
        $filtered_list = (static::$form_class)::get_assessments_list_with_extras($request);
        $full_list = (static::$form_class)::get_assessments_list(new Request(), ['country']);
        $years = $full_list->pluck('Year')->sort()->unique()->values()->toArray();
        $countries = $full_list->pluck('country.name', 'country.iso3')->sort()->unique()->toArray();

        return view(static::$form_view_prefix . 'scaling_up.list', [
            'controller' => static::class,
            'list' => $filtered_list,
            'request' => $request,
            'filter_selected' => $filter_selected,
            'countries' => $countries,
            'years' => $years
        ]);
    }


    /**
     * @param Request $request
     * @return array
     * @throws AuthorizationException
     */
    public function analysis(Request $request): array
    {
        $locale = App::getLocale();

        $action = $request->input('func');
        $parameters = $request->input('parameter');
        ModelScalingUpAnalysis::$scaling_id = $request->input(('scaling_id'));

        foreach ($parameters as $value) {
            if (is_array($value)) {
                $this->authorize('api_scaling_up', (static::$form_class)::find($value['id']));
            } else if ((int)$value > 0) {
                $this->authorize('api_scaling_up', (static::$form_class)::find($value));
            }
        }

        $response = ModelScalingUpAnalysis::$action($parameters);
        App::setLocale($locale);
        return $response;
    }

    /**
     * @param $scaling_up_id
     * @param $areas
     */
    private function save_default_names($scaling_up_id, $areas)
    {
        $isScalingUpInit = ScalingUpWdpa::retrieve_by_scaling_id($scaling_up_id);
        if (count($isScalingUpInit) === 0) {
            Common::reset_areas_ids();
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
            $custom_names[$item->FormID] = $item;
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
                ScalingUpWdpa::update_item($scaling_up_id, $id, $request->input($id), $request->input('color-' . $id));
            }
        }
    }

    /**
     * @param Request $request
     * @param null $items
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \ReflectionException
     * @throws AuthorizationException
     */
    public function report(Request $request, $items = null)
    {
        $scaling_up_id = null;
        $locale = App::getLocale();
        $areas = '';

        //create an  array with the pa ids sorted and then return it as a string
        $items_array = explode(',', $items);
        sort($items_array);

        //check authorizations
        $this->auth_saved($items_array);

        //check if the parameters are an array of numbers and pa exist in the db
        $filtered_array = array_filter($items_array, function ($value) {
            if (is_numeric($value)) {
                if ((static::$form_class)::where('FormID', $value)->count() === 0) {
                    return false;
                }
            } else {
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
            Common::reset_areas_ids();
            $this->update_custom_names($request, $items, $scaling_up_id);
        }

        $isScalingUpInit = ScalingUpWdpa::retrieve_by_scaling_id($scaling_up_id);
        // set custom names for all the pa's
        if (count($isScalingUpInit) === 0) {
            $this->save_default_names($scaling_up_id, $protected_areas['models']);
        }

        $pa_ids = implode(',', array_keys($protected_areas['models']));

        $custom_items = $this->retrieve_custom_names($scaling_up_id);
        $custom_names = array_map(function ($v) {
            return $v->name;
        }, $custom_items);
        $custom_colors = array_map(function ($v) {
            return $v->color;
        }, $custom_items);

        $protected_areas_names = implode(', ', $custom_names);

        uasort($protected_areas['models'], function ($a, $b) {
            return $a['name'] > $b['name'];
        });

        App::setLocale($locale);
        $templates_names = [
            ['name' => "protected_areas", 'title' => trans('imet-core::analysis_report.sections.list_of_names'), 'snapshot_id' => "protected_areas", 'exclude_elements' => '', 'code' => '0'],
            ['name' => "map_view", 'title' => trans('imet-core::analysis_report.sections.first'), 'snapshot_id' => "map_view", 'exclude_elements' => '', 'code' => '1'],
            ['name' => "general_elements", 'title' => trans('imet-core::analysis_report.sections.second'), 'snapshot_id' => "general_elements", 'exclude_elements' => '', 'code' => '2'],
            ['name' => "key_elements_of_conservation", 'title' => trans('imet-core::analysis_report.sections.third'), 'snapshot_id' => "management_context", 'exclude_elements' => '', 'code' => '3'],
            ['name' => "overall_management_effectiveness_scores", 'title' => trans('imet-core::analysis_report.sections.fourth'), 'snapshot_id' => "evaluation_of_protected_area_management_cycle", 'exclude_elements' => '', 'code' => '4'],
            ['name' => 'grouping_analysis_on_demand', 'title' => trans('imet-core::analysis_report.sections.fifth'), 'snapshot_id' => "grouping_analysis_on_demand", 'exclude_elements' => 'js-grouping-action-buttons,start-zone,js-render-buttons', 'code' => '5'],
            ['name' => "analysis_per_element_of_them_management_cycle", 'title' => trans('imet-core::analysis_report.sections.sixth'), 'snapshot_id' => "elements_diagrams", 'exclude_elements' => '', 'code' => '6'],
            ['name' => "relative_performance_effectiveness_intervals", 'title' => trans('imet-core::analysis_report.sections.seventh'), 'snapshot_id' => "relative_performance_effectiveness_intervals", 'exclude_elements' => 'smallMenu', 'code' => '7'],
            ['name' => "additional_option_digital_information_per_pa", 'title' => trans('imet-core::analysis_report.sections.eighth'), 'snapshot_id' => "additional_option_digital_information_per_pa", 'exclude_elements' => '', 'code' => '8'],
            ['name' => "digital_information_per_protected_area", 'title' => trans('imet-core::analysis_report.sections.ninth'), 'snapshot_id' => "digital_information_per_protected_area", 'exclude_elements' => '', 'code' => '9'],
        ];

        return view('imet-core::scaling_up.report', [
            'templates' => $templates_names,
            'pa_ids' => $pa_ids,
            'protected_areas_names' => $protected_areas_names,
            'scaling_up_id' => $scaling_up_id,
            'protected_areas' => $protected_areas,
            'custom_names' => $custom_names,
            'custom_colors' => $custom_colors,
            'request' => $request,
            'custom_items' => $custom_items
        ]);
    }

    /**
     * Export scaling up images in zip file
     *
     * @param int $scaling_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|string
     */
    public function download_zip_file(int $scaling_id)
    {
        $files = [];
        $scaling_ups = Basket::where('scaling_up_id', $scaling_id)->get();
        if (count($scaling_ups) > 0) {
            $item = ModelScalingUpAnalysis::where('id', $scaling_id)->first();

            $this->auth_saved(explode(',', $item->wdpas));

            foreach ($scaling_ups as $record) {
                $files[] = Storage::disk(Basket::BASKET_DISK)->path('') . $record->item;
            }

            if (count($files) > 1) {
                $path = Zip::compress($files,
                    "Scaling_up_" . count($files) . "_" . date('m-d-Y_hisu') . ".zip",
                    false);
                return File::download($path);
            } else {
                return trans("imet-core::analysis_report.more_than_one_file");
            }
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function preview_template(int $id)
    {
        $areas_names_concat = "";
        $records = ModelScalingUpAnalysis::where('id', $id)->first();
        if ($records) {
            $this->auth_saved(explode(',', $records->wdpas));
            ModelScalingUpAnalysis::$scaling_id = $id;

            $protected_areas = ModelScalingUpAnalysis::get_wdpas_by_form_id(explode(',', $records->wdpas));
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

    private function auth_saved($forms)
    {
        foreach ($forms as $form) {
            $this->authorize('api_scaling_up', (static::$form_class)::find($form));
        }
    }

}
