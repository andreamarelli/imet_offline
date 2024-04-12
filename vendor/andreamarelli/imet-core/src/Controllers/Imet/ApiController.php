<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\Imet\API\Assessment\ReportV1;
use AndreaMarelli\ImetCore\Models\Imet\API\Assessment\ReportV2;
use AndreaMarelli\ImetCore\Models\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\GeneralInfo;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Services\Scores\ImetScores;
use AndreaMarelli\ModularForms\Controllers\Controller;
use AndreaMarelli\ModularForms\Helpers\ModuleKey;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\StatisticsApi;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\ScalingUpApi;
use Illuminate\Http\Request;
use ErrorException;
use Illuminate\Support\Facades\App;
use Intervention\Image\Exception\NotFoundException;
use \ImetUser as User;


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
    public function get_assessment_report(Request $request, string $lang, int $wdpa_id, int $year = null): object
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

        if ($form['version'] == Imet::IMET_V1) {
            $data = ReportV1::get_assessment_report($request, $form);
        } else {
            $data = ReportV2::get_assessment_report($request, $form);
        }
        $api['data'] = ['wdpa_id' => (int)$records[0]['wdpa_id'], 'name' => $records[0]['name'], 'year' => $records[0]['Year'], 'values' => $data['data']];
        $api['labels'] = $data['labels'];

        return static::sendAPIResponse($api);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_global_average_scores(Request $request): object
    {
        $result = [];
        $api = ['data' => [], 'labels' => []];

        $list = Imet\Imet::get_assessments_list($request, ['country']);

        foreach ($list as $imet) {
            ImetScores::get_radar($imet);
        }

        $items_for_average = count($result);
        $sums = array();

        // Loop through the outer array
        foreach ($result as $innerArray) {
            // Loop through the inner array
            foreach ($innerArray as $key => $value) {
                // If the key doesn't exist in the $sums array, initialize it with 0
                if (!isset($sums[$key])) {
                    $sums[$key] = 0;
                }

                // Add the value to the sum for the current key
                $sums[$key] += $value;
            }
        }

        foreach ($sums as $k => $value) {
            $sums[$k] = round($value / $items_for_average, 2);
            $api['labels'][$k] = $k === "imet_index" ? trans('imet-core::common.indexes.imet') : trans('imet-core::common.steps_eval.' . $k);
        }
        $api['data'] = $sums;

        return static::sendAPIResponse($api);
    }

    /**
     * retrieve imet data for a given wdpa_id
     *
     * @param Request $request
     * @param string $lang
     * @param string $slug
     * @param int $wdpa_id
     * @param int|null $year
     * @return object
     * @throws ErrorException
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
        $api['data'] = ['wdpa_id' => (int)$records[0]['wdpa_id'], 'name' => $records[0]['name'], 'year' => $records[0]['Year'], 'values' => $accepted_fields];
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
        $this->authorize('api_assessment', $records[0]);
        if (count($records) === 0) {
            return static::sendAPIResponse([]);
        }
        foreach ($records as $record) {
            $item = array_merge([
                'wdpa_id' => $record['wdpa_id'],
                'year' => $record['Year'],
                'version' => $record['version']
            ],
                ImetScores::get_radar($record['FormID'], true)
            );
            $api[] = $item;
        }

        $assessment_labels = \AndreaMarelli\ImetCore\Services\Scores\ImetScores::labels();
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
        $countries = [];
        $region = $request->input("region");
        $region_item = [];
        if ($region) {
            $countries = Country::getByRegion($region);
        }
        $list = Imet\Imet::get_assessments_list($request, ['country'], false, $countries);
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
            $region_name = "name";
            if ($language !== "en") {
                $region_name .= "_" . $language;
            }
            $item['Type'] = GeneralInfo::where('FormID', $item['FormID'])->pluck('Type')->first();
            if (!$hasType || (!$type && $item['Type'] === null) || $type === $item['Type']) {
                if ($item->country->region) {
                    $region_item = [
                        'id' => $item->country->region->id,
                        'name' => $item->country->region->$region_name,
                    ];
                }
                $api[] = [
                    'wdpa_id' => $item['wdpa_id'],
                    'language' => $item['language'],
                    'name' => $item['name'],
                    'year' => $item['Year'],
                    'iso3' => $item['Country'],
                    'country' => $item->country->$country_name,
                    'region' => $region_item,
                    'type' => $item['Type'],
                    'version' => $item['version']
                ];
            }
        }

        return static::sendAPIResponse(['data' => $api]);
    }


}
