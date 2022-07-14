<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\__Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\Assessment;
use AndreaMarelli\ImetCore\Controllers\Imet\Pame;
use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\Encoder;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1;
use AndreaMarelli\ImetCore\Models\Imet\v2;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Models\Report;
use AndreaMarelli\ModularForms\Helpers\File\Zip;
use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ModularForms\Helpers\HTTP;
use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Helpers\Module;
use AndreaMarelli\ModularForms\Helpers\ModuleKey;
use AndreaMarelli\ModularForms\Models\Traits\Upload;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

use function imet_offline_version;
use function redirect;
use function report;
use function response;
use function trans;
use function view;


class Controller extends __Controller
{
    use Pame;
    use Backup;
    use ConvertSQLite;

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::';

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', static::$form_class);
        HTTP::sanitize($request, self::sanitization_rules);

        // Check and add missing Pa data to form DB record
        Imet::checkMissingPaData();

        // set filter status
        $filter_selected = !empty(array_filter($request->except('_token')));
        $countries = ProtectedArea::getCountries()
            ->keyBy('iso3')
            ->sort()
            ->toArray();
        $years = Imet::getAvailableYears();

        $list = static::get_list($request);

        return view(static::$form_view_prefix . 'list', [
            'controller' => static::class,
            'list' => $list,
            'request' => $request,
            'filter_selected' => $filter_selected,
            'countries' => array_map(function ($item) {
                return $item['name'];
            }, $countries),
            'years' => !empty($years) ? range(min($years), max($years)) : array(Carbon::today()->year),
        ]);
    }

    /**
     * Get IMET list for index view
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    protected function get_list(Request $request)
    {
        $list_v1 = v1\Imet
            ::filterList($request)
            ->with('country', 'encoder', 'responsible_interviees', 'responsible_interviers', 'assessment')
            ->get()
            ->map(function ($item){
                $item['assessment_radar'] = $item['assessment']->radar();
                return $item;
            });

        $list_v2 = v2\Imet
            ::filterList($request)
            ->with('country', 'encoder', 'responsible_interviees', 'responsible_interviers', 'assessment')
            ->get()
            ->map(function ($item){
                $item['assessment_radar'] = $item['assessment']->radar();
                return $item;
            });

        $list = $list_v1->merge($list_v2);

        $list->map(function ($item){
            $item->encoders_responsibles = [
                'encoders' => $item->encoder->unique(),
                'internal' => $item->responsible_interviers->unique(),
                'external' => $item->responsible_interviees->unique(),
            ];
            if(ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)){
                $item->wdpa_id = null;
            }
            return $item;
        });

        $hasDuplicates = Imet::foundDuplicates();
        $list->map(function ($item) use ($hasDuplicates) {
            $item['has_duplicates'] = in_array($item->getKey(), $hasDuplicates);
            return $item;
        });

        return $list;
    }

    public function scaling_up(Request $request)
    {
        $this->authorize('viewAny', static::$form_class);
        HTTP::sanitize($request, self::sanitization_rules);

        // set filter status
        $filter_selected = !empty(array_filter($request->except('_token')));
        $countries = ProtectedArea::getCountries()
            ->keyBy('iso3')
            ->sort()
            ->toArray();
        $years = Imet::getAvailableYears();

        $list = static::get_list($request);

        return view(static::$form_view_prefix . 'scaling_up.list', [
            'controller' => static::class,
            'list' => $list,
            'request' => $request,
            'filter_selected' => $filter_selected,
            'countries' => array_map(function ($item) {
                return $item['name'];
            }, $countries),
            'years' => !empty($years) ? range(min($years), max($years)) : array(Carbon::today()->year),
        ]);
    }

    /**
     * return a list of Imet's for export in json/zip
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function export_view(Request $request)
    {
        $this->authorize('viewAny', static::$form_class);
        HTTP::sanitize($request, self::sanitization_rules);

        $countries = Country::all()->sortBy(Country::LABEL)->keyBy('iso3')->toArray();
        $years = Imet::getAvailableYears();

        $list_v1 = v1\Imet
            ::filterList($request)
            ->get();

        $list_v2 = v2\Imet
            ::filterList($request)
            ->get();

        $list = $list_v1->merge($list_v2);

        $list->map(
                function (Imet $item) use ($countries) {
                    $item->iso2 = $countries[$item->Country]['iso2'] ?? null;
                    $item->country_name = $countries[$item->Country]['name'] ?? null;
                    return $item;
                }
            )
            ->makeHidden([Imet::UPDATED_AT, Imet::UPDATED_BY]);

        return view(static::$form_view_prefix . 'export', [
            'list' => $list,
            'request' => $request,
            'countries' => array_map(function ($item) {
                return $item['name'];
            }, $countries),
            'years' => !empty($years) ? range(min($years), max($years)) : array(Carbon::today()->year),
        ]);
    }

    /**
     * export records for specific module to csv format
     *
     * @param string $ids
     * @param string $module_key
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|null
     */
    public function exportModuleToCsv(string $ids, string $module_key)
    {
        $model = ModuleKey::KeyToClassName($module_key);

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
            return trans('modular-forms::common.no_record_found');
        }
        $title = str_replace(' ', '_', $query->pluck('module_code')->first());
        return File::exportToCSV($title . '.csv', $records);
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
        $countries = Country::all()->sortBy(Country::LABEL)->keyBy('iso3')->toArray();
        $countries = array_map(function ($item){
            return $item['name'];
        }, $countries);

        $imet_keys = v2\Imet::getModulesKeys();
        $imet_eval_keys = v2\Imet_Eval::getModulesKeys();
        $modules = array_merge(v2\Imet::$modules, v1\Imet_Eval::$modules);

        foreach ($modules as $key => $module) {
            $temp_array[$key] = $module;
            $modules_final_list[$key] = Module::getModulesList($temp_array);
            unset($temp_array[$key]);
        }

        return view(static::$form_view_prefix . 'v2.tools.export_csv',
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
     * Export IMET json in batch (zip file) or if only one is selected as json file
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export_batch(Request $request): BinaryFileResponse
    {
        $imetIds = explode(",", $request->input('selection'));
        $imets = Imet::whereIn('FormID', $imetIds)->get();

        $files = [];
        foreach ($imets as $imet) {
            $files[] = $this->export($imet, true, false);
        }
        $path = $files[0];
        if (count($files) > 1) {
            $fileName = "IMETS_" . count($files) . "_" . date('m-d-Y_hisu') . ".zip";
            $path = Zip::compress($files, $fileName);
        }
        return File::download($path);
    }

    /**
     * Export the full IMET form in json
     *
     * @param Imet $item
     * @param bool $to_file
     * @param bool $download
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|array
     */
    public function export(Imet $item, bool $to_file = true, bool $download = true)
    {
        $imet_id = $item->getKey();
        $imet_form = $item
            ->makeHidden(['FormID', 'UpdateBy', 'protected_area_global_id'])
            ->toArray();

        $imet_form['imet_version'] = imet_offline_version();

        $json = [
            'Imet' => $imet_form,
            'Encoders' => Encoder::exportModule($imet_id),
            'Context' => $imet_form['version'] === 'v1'
                ? v1\Imet::exportModules($imet_id)
                : v2\Imet::exportModules($imet_id),
            'Evaluation' => $imet_form['version'] === 'v1'
                ? v1\Imet_Eval::exportModules($imet_id)
                : v2\Imet_Eval::exportModules($imet_id),
            'Report' => Report::export($imet_id)
        ];

        if(ProtectedAreaNonWdpa::isNonWdpa($imet_form['wdpa_id'])){
            $json['NonWdpaProtectedArea'] = ProtectedAreaNonWdpa::export($imet_form['wdpa_id']);
        }

        if ($to_file) {
            $fileName = $item->filename('json');
            return File::exportToJSON(
                $fileName,
                $json,
                $download
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
        return view(static::$form_view_prefix . 'import');
    }

    /**
     * Import a full IMET from json file
     *
     * @param \Illuminate\Http\Request|null $request
     * @param $json
     * @param boolean $returnJson
     * @return array|\Illuminate\Http\JsonResponse|string[]
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Throwable
     */
    public function import(Request $request, $json = null, bool $returnJson = true)
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

            DB::beginTransaction();

            // Non-Wdpa protected area
            if(array_key_exists('NonWdpaProtectedArea', $json)){
                $wdpa_id = ProtectedAreaNonWdpa::import($json['NonWdpaProtectedArea']);
                $json['Imet']['wdpa_id'] = $wdpa_id;
            }

            if ($version === 'v1') {
                // Create new form and return ID
                $formID = v1\Imet::importForm($json['Imet']);
                // Populate Imet & Imet_Eval modules
                $modules_imported['Context'] = v1\Imet::importModules($json['Context'], $formID, $imet_version);
                $modules_imported['Evaluation'] = v1\Imet_Eval::importModules($json['Evaluation'], $formID, $imet_version);
                Encoder::importModule($formID, $json['Encoders'] ?? null);
                Report::import($formID, $json['Report'] ?? null);
            } elseif ($version === 'v2') {
                // Create new form and return ID
                $formID = v2\Imet::importForm($json['Imet']);
                // Populate Imet & Imet_Eval modules
                $modules_imported['Context'] = v2\Imet::importModules($json['Context'], $formID, $imet_version);
                $modules_imported['Evaluation'] = v2\Imet_Eval::importModules($json['Evaluation'], $formID, $imet_version);
                Encoder::importModule($formID, $json['Encoders'] ?? null);
                Report::import($formID, $json['Report'] ?? null);
            }
            DB::commit();

            $response['modules'] = $modules_imported;
        } catch (Exception $e) {
            DB::rollback();
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
     * Open the merge tool view
     * @param $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function merge_view($item)
    {
        $form = Imet::find($item);

        return view(static::$form_view_prefix . 'merge.list', [
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
        /** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Component\ImetModule|\AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule $module_class */
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

        return redirect()->action([Controller::class, 'merge_view'], ['item' => $destination_form_id]);
    }


    /**
     * Upload file
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function upload(Request $request): JsonResponse
    {
        $file = $request->file('file');
        $ext = $file->extension();
        $files = [];
        try {
            //upload file
            $uploaded = Upload::uploadFile($file);
            $import = new static();
            //and then check if is zip or json
            if (in_array($ext, ['zip'])) {
                $uploaded_path = Storage::disk(File::TEMP_STORAGE)->path( $uploaded['temp_filename']);
                $extractFiles = Zip::extract($uploaded_path);
                $num_extracted = 0;
                foreach ($extractFiles as $item) {
                    if(Str::endsWith($item, '.json') && $num_extracted < 10){
                        $json = json_decode(Upload::getUploadFileContent(['temp_filename' => $item]), true);
                        $files[] = $import->import(new Request(), $json, false);
                        Storage::disk(File::TEMP_STORAGE)->delete($item);
                        $num_extracted++;
                    }
                }
            } else {
                $json = json_decode(Upload::getUploadFileContent($uploaded), true);
                $files[] = $import->import(new Request(), $json, false);
                Storage::disk(File::TEMP_STORAGE)->delete($uploaded['temp_filename']);
            }

            if (count($files) === 0 || (count($files) === 1 && isset($files[0]) && $files[0]['status'] === 'error')) {
                return response()->json(["message" => trans('modular-forms::common.upload.no_files_found')], 500);
            }
        } catch (Exception $e) {
            report($e);
            return response()->json(["message" => $e->getMessage()], 500);
        }

        return response()->json($files);
    }

}
