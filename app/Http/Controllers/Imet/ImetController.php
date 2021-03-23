<?php

namespace App\Http\Controllers\Imet;

use App\Http\Controllers\Components\FormController;
use App\Library\Ofac\Module as OfacModule;
use App\Library\Utils\File\File;
use App\Library\Utils\HTTP;
use App\Models\Components\Upload;
use App\Models\Country;
use App\Models\Imet\Imet;
use App\Models\Imet\Utils\Encoder;
use App\Models\Imet\Utils\ProtectedArea;
use App\Models\Imet\v1;
use App\Models\Imet\v2;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Components\ModuleKey;
use App\Library\Utils\PhpClass;


class ImetController extends FormController
{
    protected static $form_class = Imet::class;
    protected static $form_view = 'imet';

    protected const PAGINATE = false;
    public const AUTHORIZE_BY_POLICY = true;

    public const sanitization_rules = [
        'search' => 'custom_text|nullable',
        'year' => 'digits:4|integer|nullable',
        'country' => 'min:3|max:3|alpha|nullable',
    ];

    /**
     * Override index route
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', static::$form_class);
        HTTP::sanitize($request, self::sanitization_rules);

        $search = $request->input('search', null);
        $country = $request->input('country', null);
        $year = $request->input('year', null);

        // Check for missing data
        Imet::where('Country', null)
            ->orWhere('wdpa_id', null)
            ->orWhere('name', null)
            ->get()
            ->map(function ($imet) {
                /** @var Imet $imet */
                $imet->checkMissingPaData();
            });

        // set filter status
        $show_filters = Imet::count() > 10;
        $no_filter_selected = empty(array_filter($request->except('_token')));
        if (is_imet_environment()) {
            $countries = Country::all()->sortBy(Country::LABEL)->keyBy('iso3')->toArray();
        } else {
            $countries = Country::getOFAC()->keyBy('iso3')->toArray();
        }
        $years = Imet::getAvailableYears();

        $list = [];
        if (!$show_filters || $search !== null || $country !== null || $year !== null) {

            $list = Imet::filterList($request)
                ->get()
                ->map(
                    function (Imet $item) use ($countries) {
                        $item->iso2 = $countries[$item->Country]['iso2'] ?? null;
                        $item->iso3 = $countries[$item->Country]['iso3'] ?? null;
                        $item->country_name = $countries[$item->Country]['name'] ?? null;
                        $item->encoders_responsibles = Imet::getResponsibles($item->getKey(), $item->version);
                        $item->assessment = Assessment::radar_assessment($item->getKey());
                        return $item;
                    }
                )
                ->makeHidden([Imet::UPDATED_AT, Imet::UPDATED_BY]);

            $hasDuplicates = Imet::foundDuplicates();
            $list->map(function ($item) use ($hasDuplicates) {
                $item['has_duplicates'] = in_array($item->getKey(), $hasDuplicates);
                return $item;
            });

        }

        return view('admin.' . static::$form_view . '.list', [
            'controller' => static::class,
            'list' => $list,
            'request' => $request,
            'show_filters' => $show_filters,
            'no_filter_selected' => $no_filter_selected,
            'countries' => array_map(function ($item) {
                return $item['name'];
            }, $countries),
            'years' => !empty($years) ? range(min($years), max($years)) : array(Carbon::today()->year),
        ]);
    }


    /**
     * export records for specific module to csv format
     * @param $ids
     * @param $type
     * @param $step_key
     * @param $step
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|null
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportModuleToCsv(string $ids, string $module_key)
    {
        $model = ModuleKey::KeyToClassName($module_key);
        PhpClass::ClassExist($model);

        $query = $model
            ::where(function ($query) use ($ids) {
                if ($ids) {
                    $query->whereIn('FormID', explode(',', $ids));
                }
            })
            ->whereHas('imet', function ($q) {
                $q->where('version', 'v2');
            })
            ->get();

        $records = $query->makeHidden(['UpdateBy', 'UpdateDate', 'id'])->toArray();

        if (count($records) === 0) {
            return trans('common.no_record_found');
        }
        $title = str_replace(' ', '_', $query->pluck('module_code')->first());
        return File::exportTo('CSV', $title . '.csv', $records);
    }

    /**
     * return modules list for export
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function exportListCSV(Request $request): \Illuminate\View\View
    {
        $wdpa_list = [];
        $countries_list = [];
        $modules_final_list = [];
        $temp_array = [];

        //retrieve all form records and manipulate array result
        $results = Imet::select('FormID')->distinct()->commonSearchWithWdpa($request);

        //add this to check if a filter is applied in order to return the ids or return 0 (all records)
        if ($request->filled('country') || $request->filled('year') || $request->filled('wdpa')) {
            $results = $results->implode('FormID', ',');
        } else {
            $results = 0;
        }

        //retrieve all data for filters countries, years, wdpa
        $filters = Imet::getFieldsSplitToArrays();

        //retrieve wdpa labels and ids in an array for selections
        $wdpas = ProtectedArea::getRecordsArrayByFieldIds($filters['wdpa_id'], ['wdpa_id', 'name'], 'wdpa_id');
        foreach ($wdpas as $k => $a) {
            $wdpa_list[$a['wdpa_id']] = $a['name'];
        }

        //retrieve countries labels and ids in an array for selections
        $countries = is_imet_environment()
            ? Country::all()->sortBy(Country::LABEL)->keyBy('iso3')->toArray()
            : Country::getOFAC()->keyBy('iso3')->toArray();
        $countries = array_map(function ($item) {
            return $item['name'];
        }, $countries);

        $imet_keys = v2\Imet::getModulesKeys();
        $imet_eval_keys = v2\Imet_Eval::getModulesKeys();
        $modules = array_merge(v2\Imet::$modules, v1\Imet_Eval::$modules);

        foreach ($modules as $key => $module) {
            $temp_array[$key] = $module;
            $modules_final_list[$key] = OfacModule::getModulesList($temp_array);
            unset($temp_array[$key]);
        }

        return view('admin.imet.v2.tools.export_csv',
            [
                'modules' => $modules_final_list,
                'imet_keys' => $imet_keys,
                'imet_eval_keys' => $imet_eval_keys,
                'countries' => $countries,
                'years' => $filters['Year'],
                'wdpa' => $wdpa_list,
                'request' => $request,
                'method' => 'GET',
                'results' => $results
            ]
        );
    }

    /**
     * Export the full IMET form in json
     *
     * @param Imet $item
     * @param bool $to_file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|array
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function export(Imet $item, $to_file = true)
    {
        $imet_id = $item->getKey();
        $imet_form = $item
            ->makeHidden(['FormID', 'UpdateBy', 'protected_area_global_id'])
            ->toArray();

        if ($imet_form['version'] === 'v1') {
            $imet_form['imet_version'] = v1\Imet::imet_version;
        } else {
            $imet_form['imet_version'] = v2\Imet::imet_version;
        }

        $json = [
            'Imet' => $imet_form,
            'Encoders' => Encoder::exportModule($imet_id),
            'Context' => $imet_form['version'] === 'v1'
                ? v1\Imet::exportModules($imet_id)
                : v2\Imet::exportModules($imet_id),
            'Evaluation' => $imet_form['version'] === 'v1'
                ? v1\Imet_Eval::exportModules($imet_id)
                : v2\Imet_Eval::exportModules($imet_id),
        ];

        if ($to_file) {
            $fileName = $item->filename('json');
            return File::exportTo(
                'JSON',
                $fileName,
                $json
            );
        } else {
            return $json;
        }
    }

    /**
     * View for importing an IMET from json file
     */
    public function import_view()
    {
        return view('admin.imet.import');
    }

    /**
     * Import a full IMET from json file
     *
     * @param \Illuminate\Http\Request|null $request
     * @param string|null $json
     * @param boolean $returnJson
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     * @throws \Throwable
     */
    public function import(Request $request, $json = null, $returnJson = true)
    {
        try {
            if ($json === null) {
                $fileContent = Upload::getUploadFileContent($request->get('json_file'));
                $json = json_decode($fileContent, True);
            }
            $response = ['status' => 'success', 'modules' => []];
            $modules_imported = [];

            $imet_version = $json['Imet']['imet_version'] ?? null;
            $version = $json['Imet']['version'];
            \DB::beginTransaction();

            if ($version === 'v1') {
                // Create new form and return ID
                $formID = v1\Imet::importForm($json['Imet']);
                // Populate Imet & Imet_Eval modules
                $modules_imported['Context'] = v1\Imet::importModules($json['Context'], $formID);
                $modules_imported['Evaluation'] = v1\Imet_Eval::importModules($json['Evaluation'], $formID);
                Encoder::importModule($formID, $json['Encoders'] ?? null);
            } elseif ($version === 'v2') {
                // Create new form and return ID
                $formID = v2\Imet::importForm($json['Imet']);
                // Populate Imet & Imet_Eval modules
                $modules_imported['Context'] = v2\Imet::importModules($json['Context'], $formID, false, $imet_version);
                $modules_imported['Evaluation'] = v2\Imet_Eval::importModules($json['Evaluation'], $formID, false, $imet_version);
                Encoder::importModule($formID, $json['Encoders'] ?? null);
            }
            \DB::commit();
            $response['modules'] = $modules_imported;
        } catch (\Exception $e) {
            \DB::rollback();
            $response = ['status' => 'error'];
            if (!App::environment('production')) {
                throw $e;
            }
        }

        if(!$returnJson){
            return $response;
        }

        return response()->json($response);
    }

    /**
     * Upgrade an IMET v1 to v2
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Imet\v1\Imet $item
     * @return \Illuminate\Http\RedirectResponse
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws \Exception
     */
    public function upgrade(Request $request, v1\Imet $item)
    {
        $json = static::export($item, false);
        $json['Imet']['version'] = 'v2';

        \DB::beginTransaction();

        try {
            // Create new form and return ID
            $formID = v2\Imet::importForm($json['Imet']);
            // Populate Imet & Imet_Eval modules
            v2\Imet::importModules($json['Context'], $formID, true);
            v2\Imet_Eval::importModules($json['Evaluation'], $formID, true);
            Encoder::importModule($formID, $json['Encoders'] ?? null);

            \DB::commit();
            \Session::flash('message', trans('form/imet/common.upgrade_success'));
        } catch (\Exception $e) {
            \DB::rollback();
            \Session::flash('', trans('form/imet/common.upgrade_failed'));
        }

        return redirect()->action('\\' . static::class . '@index');
    }


    public function store_prefilled(Request $request, $prev_year_selection)
    {
        $records = json_decode($request->input('records_json'), true);

        $json = static::export(Imet::find($prev_year_selection), false);
        $json['Imet']['Year'] = $records[0]['Year'];
        $json['Imet']['UpdateDate'] = Carbon::now()->format('Y-m-d H:i:s');

        \DB::beginTransaction();

        try {
            // Create new form and return ID
            $formID = v2\Imet::importForm($json['Imet']);
            // Populate Imet & Imet_Eval modules
            v2\Imet::importModules($json['Context'], $formID);
            v2\Imet_Eval::importModules($json['Evaluation'], $formID);
            Encoder::importModule($formID, $json['Encoders'] ?? null);

            \DB::commit();
            \Session::flash('message', trans('common.saved_successfully'));
            return [
                'status' => 'success',
                'entity_label' => Imet::find($formID)->{Imet::LABEL},
                'edit_url' => 'admin/' . static::$form_view . '/v2/context/' . $formID . '/edit'
            ];
        } catch (\Exception $e) {
            \DB::rollback();
            \Session::flash('message', trans('common.saved_error'));
            throw $e;
        }
    }

    /**
     * Open the merge tool view
     * @param $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function merge_view($item)
    {
        $form = Imet::find($item);

        return view('admin.imet.merge.list', [
            'primary_form' => $form,
            'duplicated_forms' => $form->getDuplicates()
        ]);
    }

    /**
     * Execute th merge of the given module
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function merge(Request $request)
    {
        /** @var \App\Models\Imet\v1\Modules\Component\ImetModule|\App\Models\Imet\v2\Modules\Component\ImetModule $module_class */
        $module_class = $request->input('module');
        $source_form_id = $request->input('source_form');
        $destination_form_id = $request->input('destination_form');

        $records = $module_class::exportModule($source_form_id);
        $records = array_map(function ($item) use ($module_class, $destination_form_id) {
            $item[(new $module_class())->getKeyName()] = null;
            $item[$module_class::$foreign_key] = $destination_form_id;
            return $item;
        }, $records);

        $request = new \Illuminate\Http\Request();
        $request->merge(['records_json' => json_encode($records)]);
        $request->merge(['form_id' => $destination_form_id]);

        $module_class::updateModule($request);

        return redirect()->action([ImetController::class, 'merge_view'], ['item' => $destination_form_id]);
    }


    /**
     *
     * @param \Illuminate\Http\Request $request
     */
    public static function api_pame(Request $request)
    {
        $conditions = [];
        if ($request->filled('iso')) {
            $conditions[] = ['Country', '=', $request->input('iso')];
        }

        $imets = (static::$form_class)
            ::select(['Year as year', 'Country as iso', 'wdpa_id', 'name'])
            ->where($conditions)
            ->get()
            ->sortBy('wdpa_id')
            ->sortBy('iso')
            ->sortBy('year')
            ->toArray();

        return self::sendAPIResponse($imets, $request);
    }
}
