<?php

use AndreaMarelli\ImetCore\Helpers\ModuleKey;
use App\Helpers\SoftwareUpdater;
use App\Models\Country;
use Illuminate\Support\Str;


function imet_offline_tool_version(): ?string
{
    return SoftwareUpdater::getCurrentVersion();
}

function is_dev_environment(): bool
{
    return Str::contains(strtolower(App::environment()), 'dev');
}

/**
 * Return ClassName from module key
 */
function get_custom_model_class_by_key($module_key): ?string
{
    // IMET namespace
    if (class_exists(ModuleKey::class)) {
        $module_class = ModuleKey::KeyToClassName($module_key);
        if ($module_class !== null) {
            return $module_class;
        }
    }

    return null;
}

/**
 * Return view from module key
 */
function get_custom_model_view_by_key($module_key, $view_type = null): ?string
{
    // IMET views
    if (Str::startsWith($module_key, 'imet')) {
        $view = ModuleKey::KeyToView($module_key, $view_type);
        if ($view !== null) {
            return $view;
        }
    }

    return null;
}


/**
 * Retrieve a list
 * Custom helper function used by AndreaMarelli\ModularForms\Helpers\Input::getList() to retrieve custom lists
 *
 * NOTE: Do not call this directly. Use instead AndreaMarelli\ModularForms\Helpers\Input::getList()
 */
function get_custom_list(string $type): array
{
    $list = imet_selection_lists($type);

    if(empty($list)){

        if ($type == "Country") {
            $list = Country::selectionList();
        }

    }

    return $list;
}
