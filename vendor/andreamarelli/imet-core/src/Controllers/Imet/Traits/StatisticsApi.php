<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Models\Imet\API\Statistics\GlobalStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use function abort;

trait StatisticsApi
{

    /**
     * @param Request $request
     * @param string $lang
     * @param string $slug
     * @param string|null $year
     * @return object
     */
    public function get_global_statistics(Request $request, string $lang, string $slug): object
    {
        $api = [];
        $type = $request->input("type");
        $year = $request->input("year");
        $country = $request->input("country");
        $version = $request->input("version");

        App::setLocale($lang);
        $slug = str_replace('-', '_', $slug);
        $func = "get_" . $slug;
        if (method_exists(GlobalStatistics::class, $func)) {
            $form_ids = GlobalStatistics::from_year_get_form_ids($request, $year, $version, $country, $type);
            if (in_array($func, ['get_assessments_performed_by_country', 'get_pas_rating'])) {
                $api = GlobalStatistics::$func($form_ids, $lang);
            } else {
                $api = GlobalStatistics::$func($form_ids);
            }

        } else {
            abort(404, trans('imet-core::api.error_messages.page_not_found'));
        }

        return static::sendAPIResponse( $api);
    }




}
