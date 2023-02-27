<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Models\Imet\API\Assessment\ReportV1;
use AndreaMarelli\ImetCore\Models\Imet\API\Assessment\ReportV2;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\GeneralInfo;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use AndreaMarelli\ModularForms\Controllers\Controller;
use AndreaMarelli\ModularForms\Helpers\ModuleKey;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\StatisticsApi;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\ScalingUpApi;
use Illuminate\Http\Request;
use ErrorException;
use Illuminate\Support\Facades\App;
use Intervention\Image\Exception\NotFoundException;


class ApiController extends Controller
{
    public const AUTHORIZE_BY_POLICY = true;
    use ScalingUpApi;
    use Assessment;
    use StatisticsApi;

    /**
     * @param Request $request
     * @param string $lang
     * @param int $wdpa_id
     * @param int|null $year
     * @return \Illuminate\Http\JsonResponse
     * @throws ErrorException
     * @throws \ReflectionException
     */
    public function get_assessment_report(Request $request, string $lang, int $wdpa_id, int $year = null) : object
    {
        $api = ['data' => [], 'labels' => []];

        $records = $request->attributes->get('records');
        $this->authorize('api_assessment', $records[0]);
        if (count($records) === 0) {
            return static::sendAPIResponse([]);
        }

        if (count($records) > 1) {
            throw new ErrorException(trans('imet-core::api.error_messages.multiple_records_found'));
        }

        $form_id = $records[0]['FormID'] ?? null;
        $form = Imet::find($form_id);

        if($form['version'] == Imet::IMET_V1) {
            $data = ReportV1::get_assessment_report($request, $form);
        }else{
            $data = ReportV2::get_assessment_report($request, $form);
        }
        $api['data'] = ['wdpa_id' => (int)$records[0]['wdpa_id'], 'name' => $records[0]['name'], 'year' => $records[0]['Year'], 'values' => $data['data']];
        $api['labels'] = $data['labels'];

        return static::sendAPIResponse($api);
    }

    /**
     * retrieve imet data for a given wdpa_id
     *
     * @param Request $request
     * @param string $lang
     * @param string $key
     * @param int $wdpa_id
     * @param int|null $year
     * @return object
     * @throws ErrorException
     */
    public function get_imet(Request $request, string $lang, string $slug, int $wdpa_id, int $year = null): object
    {
        $api = ['data' => [], 'labels' => []];

        $records = $request->attributes->get('records');
        $model = ModuleKey::KeyToClassName($slug);
        $this->authorize('api_details', [$records[0], $model]);
        if (count($records) > 1) {
            throw new ErrorException(trans('imet-core::api.error_messages.multiple_records_found'));
        }

        $form_id = $records[0]['FormID'] ?? null;
        if ($form_id === null) {
            throw new NotFoundException(trans('imet-core::api.error_messages.no_records_found'));
        }

        $items = $model::where('FormID', $form_id)->get()->makeHidden(['UpdateBy', 'UpdateDate', 'id', 'FormID', 'upload', 'hidden', 'file_BYTEA', 'file']);
        $accepted_fields = [];
        if (count($items) > 0) {
            foreach ($items as $field) {
                $filtered_fields = [];
                foreach ($field->module_fields as $value) {
                    if (isset($value['type']) && !in_array($value['type'], ['upload', 'hidden', 'file_BYTEA', 'file'])) {
                        $filtered_fields[$value['name']] = $field[$value['name']];
                        $api['labels'][$value['name']] = $value['label'];
                    }
                }
                $accepted_fields[] = $filtered_fields;
            }
        }
        $api['data'] = ['wdpa_id' => (int)$records[0]['wdpa_id'],  'name' => $records[0]['name'], 'year' => $records[0]['Year'], 'values' => $accepted_fields];
        return static::sendAPIResponse($api);
    }

    /**
     * get imet statistics for radar chart use
     * @param Request $request
     * @param string $lang
     * @param int $wdpa_id
     * @param int|null $year
     * @return object
     */
    public function get_imet_statistics_radar(Request $request, string $lang, int $wdpa_id, int $year = null): object
    {
        $api = [];
        $labels = [];
        App::setLocale($lang);
        $records = $request->attributes->get('records');

        if (count($records) === 0) {
            return static::sendAPIResponse([]);
        }
        foreach ($records as $record) {
            $item = array_merge([
                'wdpa_id' => $record['wdpa_id'],
                'year' => $record['Year'],
                'version' => $record['version']
            ],
                $record['version']==Imet::IMET_V2
                    ? V2StatisticsService::get_radar_scores($record['FormID'])
                    : V1ToV2StatisticsService::get_radar_scores($record['FormID'])
            );
            $api[] = $item;
        }

        $assessment_labels = \AndreaMarelli\ImetCore\Services\Statistics\StatisticsService::steps_labels();
        foreach ($assessment_labels as $key => $values) {
            foreach ($values['abbreviations'] as $abb_key => $value) {
                $labels[$key][$value] = $values['full'][$abb_key];
            }
        }

        return static::sendAPIResponse(['data' => $api, 'labels' => $labels]);
    }

    /**
     * @param Request $request
     * @param string $language
     * @return object
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function get_protected_areas_list(Request $request, string $language = 'en'): object
    {

        $api = [];
        $list = Imet::get_assessments_list($request, ['country']);
        $hasType = $request->has("type");
        $type = $request->input("type");


        $list->map(function ($item) {
            if (ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
                $item->wdpa_id = null;
            }
            return $item;
        });

        foreach ($list as $item) {
            $country_name = "name_" . $language;
            $item['Type'] = GeneralInfo::where('FormID', $item['FormID'])->pluck('Type')->first();
            if (!$hasType  || (!$type && $item['Type'] === null) || $type === $item['Type']) {
                $api[] = [
                    'wdpa_id' => $item['wdpa_id'],
                    'language' => $item['language'],
                    'name' => $item['name'],
                    'year' => $item['Year'],
                    'iso3' => $item['Country'],
                    'country' => $item->country->$country_name,
                    'type' => $item['Type'],
                    'version' => $item['version']
                ];
            }
        }

        return static::sendAPIResponse(['data' => $api]);
    }




}
