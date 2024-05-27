<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;


/**
 * @return mixed
 */
function is_cache_scores_enabled(){
    return env("CACHED_SCORES", false);
}

/**
 * Check if App::environment is IMET related (ex. imetoffline or imetglobal)
 *
 * @return bool
 */
function is_imet_environment(): bool
{
    return App::environment('imetoffline')
        || App::environment('imetglobal');
}

/**
 * Return IMET offline version
 */
function imet_offline_version(): string
{
    return config('imet-core.offline_version');
}

/**
 * Imet selection lists
 *
 * @param string $type
 * @return array
 */
function imet_selection_lists(string $type): array
{
    $list = [];

    if (Str::startsWith($type, 'ImetV1')
        || Str::startsWith($type, 'ImetV2')
        || Str::startsWith($type, 'Imet_')
        || Str::startsWith($type, 'OECM_')
        || Str::startsWith($type, 'ImetOECM_')) {
        preg_match("/Imet([\w\d]{0,2}|[\w\d]{0,4})\_([\w]+)/", $type, $matches);

        if ($matches[2] == "ProtectedArea") {
            $list = \AndreaMarelli\ImetCore\Models\ProtectedArea::selectionList();
        } elseif ($matches[2] == "Country") {
            $list = \AndreaMarelli\ImetCore\Models\Country::selectionList();
        } elseif ($matches[2] == "Currency") {
            $list = \AndreaMarelli\ImetCore\Models\Currency::imetV1List();
        } elseif ($matches[1] != "") {

            $list = trans('imet-core::' . strtolower($matches[1]) . '_lists.' . $matches[2]);
        }

    }

    return $list;
}
