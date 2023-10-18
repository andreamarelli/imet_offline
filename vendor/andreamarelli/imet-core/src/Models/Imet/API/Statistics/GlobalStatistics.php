<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Areas;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\GeneralInfo;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AndreaMarelli\ImetCore\Models\Imet\v1;
use AndreaMarelli\ImetCore\Models\Imet\v2;
use AndreaMarelli\ImetCore\Models\Region;
use AndreaMarelli\ImetCore\Models\Country;

class GlobalStatistics
{
    public static bool $hide_protected_area_info = true;

    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_pa_average_score_per_iucn_categories(array $form_ids): array
    {
        $wdpa_ids = [];
        $imet_index_average = [];
        $list_v2 = v2\Imet::whereIn('FormID', $form_ids)->select(['wdpa_id', 'FormID', 'version'])->get();
        $list_v1 = v1\Imet::whereIn('FormID', $form_ids)->select(['wdpa_id', 'FormID', 'version'])->get();

        $list = $list_v1->merge($list_v2);

        foreach ($list as $item) {
            $wdpa_ids[$item['wdpa_id']] = [
                'wdpa_id' => $item['wdpa_id'],
                'imet_index' => $item['version'] === Imet::IMET_V1
                    ? V1ToV2StatisticsService::get_imet_score($item['FormID'])
                    : V2StatisticsService::get_imet_score($item['FormID'])
            ];
        }

        $fn = function ($item) use (&$form_ids, &$imet_index_average, $wdpa_ids) {
            $key = $item['iucn_category'];
            $form_ids[$item['FormID']]['iucn_category'] = $key;

            if (!isset($imet_index_average[$key])) {
                $imet_index_average[$key] = [];
            }

            $imet_index_average[$key][] = $wdpa_ids[$item['wdpa_id']]['imet_index'];
            return $item;
        };

        ProtectedArea::select('wdpa_id', 'iucn_category')
            ->whereIn('wdpa_id', array_keys($wdpa_ids))
            ->get()
            ->map($fn);

        $imet_index_average = array_map(function ($key, $item) {
            return ['IUCNCategory' => $key, 'total' => round(array_sum($item) / count($item), 2)];
        }, array_keys($imet_index_average), $imet_index_average);

        usort($imet_index_average, function ($a, $b) {
            return $a['total'] < $b['total'];
        });
        return ['data' => $imet_index_average];
    }

    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_pa_number_per_iucn_categories(array $form_ids): array
    {

        $list_v1 = Imet::whereIn('FormID', $form_ids)->select()->pluck('wdpa_id')
            ->toArray();

        $number_of_pas_per_iucn_categories = ProtectedArea::select(DB::raw('iucn_category'), DB::raw('count("iucn_category") as total'));

        if (count($list_v1) > 0) {
            $number_of_pas_per_iucn_categories = $number_of_pas_per_iucn_categories->whereIn('wdpa_id', $list_v1);
        }

        $number_of_pas_per_iucn_categories = $number_of_pas_per_iucn_categories->groupBy(DB::raw('iucn_category'))
            ->orderBy('total', 'desc')
            ->get()->map(function ($item) {
                $values = [];
                $values['iucn_category'] = $item['iucn_category'];
                $values['total'] = $item['total'];
                return $values;
            });

        return ['data' => $number_of_pas_per_iucn_categories];
    }

    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_pa_number_of_marines_and_terrestrials(array $form_ids): array
    {
        $pa_number_or_marines_and_terrestrials = GeneralInfo::select(DB::raw('"Type"'), DB::raw('count("Type") as total'));

        if (count($form_ids) > 0) {
            $pa_number_or_marines_and_terrestrials = $pa_number_or_marines_and_terrestrials->whereIn('FormID', $form_ids);
        }

        $pa_number_or_marines_and_terrestrials = $pa_number_or_marines_and_terrestrials->groupBy(DB::raw('"Type"'))
            ->orderBy('total', 'desc')
            ->get()->map(function ($item) {
                $values = [];
                if ($item['Type'] === "terrestrial") {
                    $values['Type'] = ucfirst(trans('imet-core::common.terrestrial'));
                } else {
                    $values['Type'] = ucfirst(trans('imet-core::common.marine'));
                }

                $values['total'] = $item['total'];
                return $values;
            });

        return ['data' => $pa_number_or_marines_and_terrestrials];
    }

    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_pa_areas_small(array $form_ids): array
    {
        $pa_areas_large = static::get_pa_areas_large($form_ids, 'asc', 5);

        return ['data' => $pa_areas_large['data']];
    }

    /**
     * @param array $form_ids
     * @param string $lang
     * @param string $order
     * @param int $limit
     * @return array
     */
    public static function get_pa_areas_large(array $form_ids, string $order = 'desc', int $limit = 5): array
    {
        $pa_areas = Areas::select(['WDPAArea', 'FormID']);

        if (count($form_ids) > 0) {
            $pa_areas = $pa_areas->whereIn('FormID', $form_ids);
        }

        $pa_areas = $pa_areas->where('WDPAArea', '<>', Null)
            ->orderBy('WDPAArea', $order)->limit($limit)
            ->get()->toArray();

        return ['data' => $pa_areas];
    }

    /**
     * @param array $form_ids
     * @param string $language
     * @return array
     * @throws \Exception
     */
    public static function get_number_of_assessments_by_region(array $form_ids, string $language = 'en'): array
    {
        $list = [];
        $regions = Region::select()->get();
        foreach($regions as $region){

            $countries = Country::getByRegion($region['id']);

            $list[$region['name']] = Imet::select('FormID')->whereIn('Country', $countries)->get()->count();
        }
        return ['data' => $list];
    }

    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_total_number_of_assessments(array $form_ids): array
    {
        $number_of_pas = Imet::
        select(DB::raw('count("FormID") as total'));

        if (count($form_ids) > 0) {
            $number_of_pas = $number_of_pas->whereIn('FormID', $form_ids);
        }

        $number_of_pas = $number_of_pas->get()->toArray();
        return ['data' => $number_of_pas[0]];
    }


    /**
     * @param array $form_ids
     * @return array
     */
    public static function get_assessments_performed_by_year(array $form_ids): array
    {
        $number_of_pas_by_year = Imet::select(DB::raw('"Year"'), DB::raw('count("Year") as total'));

        if (count($form_ids) > 0) {
            $number_of_pas_by_year = $number_of_pas_by_year->whereIn('FormID', $form_ids);
        }

        $number_of_pas_by_year = $number_of_pas_by_year->groupBy(DB::raw('"Year"'))
            ->orderBy(DB::raw('"Year"'))
            ->get()->toArray();

        return ['data' => $number_of_pas_by_year];
    }

    /**
     * @param array $form_ids
     * @param string $language
     * @return array
     */
    public static function get_assessments_performed_by_country(array $form_ids, string $language = 'en'): array
    {
        $name = 'name_' . $language;

        $number_of_pas_by_country = Imet::with('country')
            ->select(DB::raw('"Country"'), DB::raw('count("Country") as total'));

        if (count($form_ids) > 0) {
            $number_of_pas_by_country = $number_of_pas_by_country->whereIn('FormID', $form_ids);
        }

        $number_of_pas_by_country = $number_of_pas_by_country->groupBy(DB::raw('"Country"'))
            ->orderBy('total', 'desc')
            ->get()->map(function ($item) use ($name) {
                $values = [];
                $values['country'] = $item->country->$name;
                $values['total'] = $item->total;
                return $values;
            });

        return ['data' => $number_of_pas_by_country];
    }

    /**
     * @param array $form_ids
     * @param string $language
     * @return array[]
     */
    public static function get_global_pas_rating(array $form_ids, string $language = 'en'): array
    {
        $api = ['data' => [], 'labels' => []];
        $list_of_pas_rating = static::get_pas_rating($form_ids, $language, false, true);
        $sums = []; // To store the sums for each key

        foreach ($list_of_pas_rating['data'] as $item) {
            foreach ($item as $key => $value) {
                // Initialize the sum if it doesn't exist
                if (!isset($sums[$key])) {
                    $sums[$key] = 0;
                }
                // Add the value to the sum
                $sums[$key] += $value;
            }
        }

        $items_length = count($list_of_pas_rating['data']);
        foreach ($sums as $key => $item) {
            $sums[$key] = round($item / $items_length, 1);
            $api['labels'][$key] = $key === "imet_index" ? trans('imet-core::common.indexes.imet') :trans('imet-core::common.steps_eval.'.$key);
        }
        $api['data'] = $sums;
        return $api;
    }

    /**
     * @param array $form_ids
     * @param string $language
     * @param bool $only_top_rating
     * @param bool $all_scores
     * @return array
     */
    public static function get_pas_rating(array $form_ids, string $language = 'en', bool $only_top_rating = true, bool $all_scores = false): array
    {
        $name = 'name_' . $language;
        $country_fields = 'country:iso3,' . $name;

        $i = 0;
        $list_of_pas_rating_v2 = v2\Imet::whereIn('FormID', $form_ids)->where('version', 'v2')->with($country_fields);
        $list_of_pas_rating_v1 = v1\Imet::whereIn('FormID', $form_ids)->where('version', 'v1')->with($country_fields);

        $list_of_pas_rating_v2 = $list_of_pas_rating_v2->get()
            ->map(function ($item) use ($name, &$i, $all_scores) {
                $i++;
                return static::pas_rating_fields($item, $name, $i, $all_scores);
            })->toArray();
        $list_of_pas_rating_v1 = $list_of_pas_rating_v1->get()
            ->map(function ($item) use ($name, &$i, $all_scores) {
                $i++;
                return static::pas_rating_fields($item, $name, $i, $all_scores);
            })->toArray();

        $list_of_pas_rating = array_merge($list_of_pas_rating_v1, $list_of_pas_rating_v2);
        if (!$all_scores) {
            usort($list_of_pas_rating, function ($a, $b) {
                return $a['imet_index'] < $b['imet_index'];
            });
        }
        if ($only_top_rating) {
            $list_of_pas_rating = array_slice($list_of_pas_rating, 0, 10);
        }

        return ['data' => $list_of_pas_rating];
    }

    /**
     * @param Request $request
     * @param string|null $year
     * @param string|null $version
     * @param array|null $country
     * @param string|null $type
     * @return array
     */
    public static function from_year_get_form_ids(Request $request, string $year = null, string $version = null, array $country = null, string $type = null): array
    {
        $form_ids = [];
        $records = null;
        if ($year !== null || $version !== null || $country !== null) {
            $records = new Imet();

            if ($year !== null) {
                $records = $records::where('Year', $year);

            }
            if ($version !== null) {
                $records = $records->where('version', $version);
            }
            if ($country[0] !== null) {
                $records = $records->whereIn('Country', $country);
            }
            $form_ids = $records->pluck('FormID')->toArray();
        }

        if (count($form_ids) > 0 && $type !== null) {
            $form_ids = GeneralInfo::where('Type', $type)
                ->whereIn('FormID', $form_ids)
                ->pluck('FormID')
                ->toArray();
        }

        return $form_ids;
    }

    /**
     * @param Imet $item
     * @param string $name
     * @param int $i
     * @param bool $global_scores
     * @return array
     */
    public static function pas_rating_fields(Imet $item, string $name, int $i = 1, bool $global_scores = false): array
    {
        $new_item = [];
        $new_item['FormID'] = $item['FormID'];
        if (static::$hide_protected_area_info) {
            $new_item['wdpa_id'] = "-";
            $new_item['name'] = ucfirst(trans_choice('imet-core::common.protected_area.protected_area', 0)) . " " . $i;
        } else {
            $new_item['wdpa_id'] = $item['wdpa_id'];
            $new_item['name'] = $item['name'];
        }
        $new_item['Year'] = $item['Year'];

        $new_item['country'] = $item->country["$name"];

        if ($global_scores) {
            $new_item = $item['version'] === Imet::IMET_V1
                ? V1ToV2StatisticsService::get_scores($item['FormID'])
                : V2StatisticsService::get_scores($item['FormID']);
        } else {
            $new_item['imet_index'] = $item['version'] === Imet::IMET_V1
                ? V1ToV2StatisticsService::get_imet_score($item['FormID'])
                : V2StatisticsService::get_imet_score($item['FormID']);

        }

        return $new_item;
    }


}
