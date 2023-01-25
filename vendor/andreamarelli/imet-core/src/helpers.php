<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;


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
 * Check if App::environment is IMET related (ex. imetoffline or imetglobal)
 *
 * @return bool|string
 */
function imet_offline_version()
{
    return env('IMET_OFFLINE_VERSION');
}

/**
 * Imet selection lists
 *
 * @param string $type
 * @return array
 */
function imet_selection_lists(string $type): array
{
    $list  = [];

    if (Str::startsWith($type, 'ImetV1')
        || Str::startsWith($type, 'ImetV2')
        || Str::startsWith($type, 'Imet_')) {
        preg_match("/Imet([\w\d]{0,2})\_([\w]+)/", $type, $matches);

        if ($matches[2] == "ProtectedArea") {
            $list = \AndreaMarelli\ImetCore\Models\ProtectedArea::selectionList();
        } elseif ($matches[2] == "Country") {
            $list = \AndreaMarelli\ImetCore\Models\Country::selectionList();
        } elseif ($matches[2] == "Currency") {
            $list = \AndreaMarelli\ImetCore\Models\Currency::imetV1List();
        } elseif ($matches[1] != "") {
            $list = trans('imet-core::'.strtolower($matches[1]).'_lists.' . $matches[2]);
        }

    }

    return $list;
}
