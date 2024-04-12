<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\Imet;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ModularForms\Helpers\File\Zip;
use AndreaMarelli\ModularForms\Helpers\HTTP;
use AndreaMarelli\ModularForms\Helpers\Module;
use AndreaMarelli\ModularForms\Helpers\ModuleKey;
use AndreaMarelli\ModularForms\Models\Traits\Upload;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use Throwable;
use function imet_offline_version;
use function report;
use function response;
use function trans;


trait ImportExportJSON
{
    /**
     * Upload file
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
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
                $uploaded_path = Storage::disk(File::TEMP_STORAGE)->path($uploaded['temp_filename']);
                $extractFiles = Zip::extract($uploaded_path);
                $num_extracted = 0;
                foreach ($extractFiles as $item) {
                    if (Str::endsWith($item, '.json') && $num_extracted < 10) {
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

    /**
     * return a list of Imet's for export in json/zip
     * @param Request $request
     * @return Application|Factory|\Illuminate\Contracts\View\View
     * @throws AuthorizationException
     */
    public function export_view(Request $request)
    {
        $this->authorize('exportAll', static::$form_class);
        HTTP::sanitize($request, self::sanitization_rules);

        /** @var Imet\Imet $form_class */
        $form_class = static::$form_class;

        // retrieve IMET list
        $filtered_list = $form_class::get_assessments_list_with_extras($request);
        $full_list = $form_class::get_assessments_list(new Request(), ['country']);
        $years = $full_list->pluck('Year')->sort()->unique()->values()->toArray();
        $countries = $full_list->pluck('country.name', 'country.iso3')->sort()->unique()->toArray();

        return view(static::$form_view_prefix . '.export', [
            'route_prefix' => static::ROUTE_PREFIX,
            'list' => $filtered_list,
            'request' => $request,
            'countries' => $countries,
            'years' => $years
        ]);
    }

    /**
     * export records for specific module to csv format
     *
     * @param string $ids
     * @param string $module_key
     * @return BinaryFileResponse|string|null
     */
    public function exportModuleToCsv(string $ids, string $module_key): ?BinaryFileResponse
    {
        $model = ModuleKey::KeyToClassName($module_key);

        $query = $model
            ::where(function ($query) use ($ids) {
                if ($ids) {
                    $query->whereIn('FormID', explode(',', $ids));
                }
            })
            ->whereHas('imet', function ($q) {
                $q->where('version', Imet\Imet::IMET_V2);
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
     * @return Application|Factory|View
     */
    public function exportListCSV(Request $request): View
    {
        $wdpa_list = [];
        $modules_final_list = [];
        $temp_array = [];

        //retrieve all form records and manipulate array result
        $results = Imet\Imet::select('FormID')->distinct()->commonSearchWithWdpa($request);

        //add this to check if a filter is applied in order to return the ids or return 0 (all records)
        if ($request->filled('country') || $request->filled('year') || $request->filled('wdpa')) {
            $results = $results->implode('FormID', ',');
        } else {
            $results = 0;
        }

        //retrieve all data for filters countries, years, wdpa
        $filters = Imet\Imet::getFieldsSplitToArrays();

        //retrieve wdpa labels and ids in an array for selections
        $wdpas = ProtectedArea::getRecordsArrayByFieldIds($filters['wdpa_id'], ['wdpa_id', 'name'], 'wdpa_id');
        foreach ($wdpas as $k => $a) {
            $wdpa_list[$a['wdpa_id']] = $a['name'];
        }

        //retrieve countries labels and ids in an array for selections
        $countries = Country::all()->sortBy(Country::LABEL)->keyBy('iso3')->toArray();
        $countries = array_map(function ($item) {
            return $item['name'];
        }, $countries);

        $imet_keys = Imet\v2\Imet::getModulesKeys();
        $imet_eval_keys = Imet\v2\Imet_Eval::getModulesKeys();
        $modules = array_merge(Imet\v2\Imet::$modules, Imet\v1\Imet_Eval::$modules);

        foreach ($modules as $key => $module) {
            $temp_array[$key] = $module;
            $modules_final_list[$key] = Module::getModulesList($temp_array);
            unset($temp_array[$key]);
        }

        return view(static::$form_view_prefix . '.tools.export_csv',
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
     * @return BinaryFileResponse
     * @throws AuthorizationException
     */
    public function export_batch(Request $request): BinaryFileResponse
    {
        $imetIds = explode(",", $request->input('selection'));

        $files = [];
        foreach ($imetIds as $imet) {
            $files[] = $this->export($imet, false, true, false);
        }
        $path = $files[0];
        if (count($files) > 1) {
            $fileName = "IMETS_" . count($files) . "_" . date('m-d-Y_hisu') . ".zip";
            $path = Zip::compress($files, $fileName);
        }
        return File::download($path);
    }

    /**
     * Export the IMET form in json
     *
     * @throws AuthorizationException
     */
    public function export($item, bool $exclude_attachments = false, bool $to_file = true, bool $download = true): BinaryFileResponse|array|string
    {
        $this->authorize('export', (static::$form_class)::find($item));

        if ($item instanceof Imet\Imet) {
            $imet_id = $item->getKey();
            $imet = $item;
        } else {
            $imet_id = $item;
            $imet = (static::$form_class)::find($item);
        }

        $imet_form = $imet
            ->makeHidden(['FormID', 'UpdateBy', 'protected_area_global_id'])
            ->toArray();

        $imet_form['imet_version'] = imet_offline_version();

        // #####  IMET V1  #####
        if ($imet_form['version'] === Imet\Imet::IMET_V1) {
            $json = [
                'Imet' => $imet_form,
                'Encoders' => Imet\Encoder::exportModule($imet_id),
                'Context' => Imet\v1\Imet::exportModules($imet_id, $exclude_attachments),
                'Evaluation' => Imet\v1\Imet_Eval::exportModules($imet_id, $exclude_attachments),
                'Report' => Imet\Report::export($imet_id)
            ];
        } // #####  IMET V2  #####
        elseif ($imet_form['version'] === Imet\Imet::IMET_V2) {
            $json = [
                'Imet' => $imet_form,
                'Encoders' => Imet\Encoder::exportModule($imet_id),
                'Context' => Imet\v2\Imet::exportModules($imet_id, $exclude_attachments),
                'Evaluation' => Imet\v2\Imet_Eval::exportModules($imet_id, $exclude_attachments),
                'Report' => Imet\Report::export($imet_id)
            ];
        } // #####  IMET OECM  #####
        elseif ($imet_form['version'] === Imet\Imet::IMET_OECM) {
            $json = [
                'Imet' => $imet_form,
                'Encoders' => Imet\oecm\Encoder::exportModule($imet_id),
                'Context' => Imet\oecm\Imet::exportModules($imet_id, $exclude_attachments),
                'Evaluation' => Imet\oecm\Imet_Eval::exportModules($imet_id, $exclude_attachments),
                'Report' => Imet\oecm\Report::export($imet_id)
            ];
        }

        if (ProtectedAreaNonWdpa::isNonWdpa($imet_form['wdpa_id'])) {
            $json['NonWdpaProtectedArea'] = ProtectedAreaNonWdpa::export($imet_form['wdpa_id']);
        }

        if ($to_file) {
            $fileName = $imet->filename('json');
            return File::exportToJSON(
                $fileName,
                $json,
                $download
            );
        } else {
            return $json;
        }
    }

    public function export_no_attachments($item, bool $to_file = true, bool $download = true): BinaryFileResponse|array
    {
       return $this->export($item, true);
    }

    /**
     * View for importing an IMET from json file
     *
     * @throws AuthorizationException
     */
    public function import_view()
    {
        $this->authorize('viewAny', static::$form_class);

        return view(static::$form_view_prefix . '.import', [
            'controller' => static::class
        ]);
    }

    /**
     * Import a full IMET from json file
     *
     * @param Request|null $request
     * @param $json
     * @param boolean $returnJson
     * @return array|JsonResponse|string[]
     * @throws FileNotFoundException
     * @throws Throwable
     */
    public function import(Request $request, $json = null, bool $returnJson = true)
    {
        try {
            if ($json === null) {
                $fileContent = Upload::getUploadFileContent($request->get('json_file'));
                $json = json_decode($fileContent, True);
            }


            if ($json['Imet']['version'] === Imet\Imet::IMET_V1) {
                $imet = (new Imet\v1\Imet($json['Imet']))->fill($json['Imet']);
            } else if ($json['Imet']['version'] === Imet\Imet::IMET_V2) {
                $imet = (new Imet\v2\Imet($json['Imet']))->fill($json['Imet']);
            } else if ($json['Imet']['version'] === Imet\Imet::IMET_OECM) {
                $imet = (new Imet\oecm\Imet($json['Imet']))->fill($json['Imet']);
            }

            $this->authorize('view', $imet);

            $response = ['status' => 'success', 'modules' => []];

            DB::beginTransaction();

            // Non-Wdpa protected area
            if (array_key_exists('NonWdpaProtectedArea', $json)) {
                $wdpa_id = ProtectedAreaNonWdpa::import($json['NonWdpaProtectedArea']);
                $json['Imet']['wdpa_id'] = $wdpa_id;
            }

            // Import modules
            [$formID, $modules_imported] = static::import_modules($json);

            DB::commit();

            // backup in JSON
            (new static)->backup($formID, $json['Imet']['version']);

            $response['modules'] = $modules_imported;
        } catch (Exception $e) {
            DB::rollback();
            $response = ['status' => 'error'];
            if (!App::environment('production')) {
                throw $e;
            }
        }

        if (!$returnJson) {
            return $response;
        }

        return response()->json($response);
    }

    /**
     * Import all the IMET modules
     *
     * @param $json
     * @param bool $with_report
     * @return array
     * @throws FileNotFoundException
     */
    protected static function import_modules($json, bool $with_report = true): array
    {
        $modules_imported = [];
        $imet_version = $json['Imet']['imet_version'] ?? null;
        $version = $json['Imet']['version'];

        // #####  IMET V1  #####
        if ($version === Imet\Imet::IMET_V1) {
            $formID = Imet\v1\Imet::importForm($json['Imet']);
            $modules_imported['Context'] = Imet\v1\Imet::importModules($json['Context'], $formID, $imet_version);
            $modules_imported['Evaluation'] = Imet\v1\Imet_Eval::importModules($json['Evaluation'], $formID, $imet_version);
            Imet\Encoder::importModule($formID, $json['Encoders'] ?? null);
            if ($with_report) {
                Imet\Report::import($formID, $json['Report'] ?? null);
            }
        } // #####  IMET V2  #####
        elseif ($version === Imet\Imet::IMET_V2) {
            $formID = Imet\v2\Imet::importForm($json['Imet']);
            $modules_imported['Context'] = Imet\v2\Imet::importModules($json['Context'], $formID, $imet_version);
            $modules_imported['Evaluation'] = Imet\v2\Imet_Eval::importModules($json['Evaluation'], $formID, $imet_version);
            Imet\Encoder::importModule($formID, $json['Encoders'] ?? null);
            if ($with_report) {
                Imet\Report::import($formID, $json['Report'] ?? null);
            }
        } // #####  IMET OECM  #####
        elseif ($version === Imet\Imet::IMET_OECM) {
            $formID = Imet\oecm\Imet::importForm($json['Imet']);
            $modules_imported['Context'] = Imet\oecm\Imet::importModules($json['Context'], $formID, $imet_version);
            $modules_imported['Evaluation'] = Imet\oecm\Imet_Eval::importModules($json['Evaluation'], $formID, $imet_version);
            Imet\oecm\Encoder::importModule($formID, $json['Encoders'] ?? null);
            if ($with_report) {
                Imet\oecm\Report::import($formID, $json['Report'] ?? null);
            }
        }


        return [$formID, $modules_imported];
    }


}
