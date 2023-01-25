<?php

use Illuminate\Support\Str;


/**
 * Return ClassName from module key
 *
 * @param $module_key
 * @return string
 */
function get_custom_model_class_by_key($module_key): ?string
{
    // IMET namespace
    if (class_exists(\AndreaMarelli\ImetCore\Helpers\ModuleKey::class)) {
        $module_class = \AndreaMarelli\ImetCore\Helpers\ModuleKey::KeyToClassName($module_key);
        if ($module_class !== null) {
            return $module_class;
        }
    }

    return null;
}

/**
 * Return view from module key
 *
 * @param $module_key
 * @param null $view_type
 * @return string|null
 */
function get_custom_model_view_by_key($module_key, $view_type = null): ?string
{
    // IMET views
    if (\Illuminate\Support\Str::startsWith($module_key, 'imet')) {
        $view = \AndreaMarelli\ImetCore\Helpers\ModuleKey::KeyToView($module_key, $view_type);
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
 * NOTE: Avoid to call this directly. Use instead AndreaMarelli\ModularForms\Helpers\Input::getList()
 *
 * @param string $type
 * @return array
 */
function get_custom_list(string $type): array
{
    $list = imet_selection_lists($type);

    if(empty($list)){

        if ($type == "Country") {
            $list = \App\Models\Country::selectionList();
        }

    }

    return $list;
}
