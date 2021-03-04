<?php


if (! function_exists('cleanString')) {
    /**
     * clean a string from special characters and replace spaces with hyphen
     * @param $string
     * @return string|string[]|null
     */
    function cleanString($string)
    {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}

if (! function_exists('vueAction')) {

    /**
     * Generate action url with dummy item ID (Ex. /path/to/route/@DUMMY@/action_name)
     * @param \App\Http\Controllers\Controller $controller
     * @param $action
     * @param $item
     * @return string
     */
    function vueAction($controller, $action, $item)
    {
        $DUMMY_ITEM = '@DUMMY@';
        $url = action([$controller, $action], [$DUMMY_ITEM]);
        return str_replace($DUMMY_ITEM, "'+" . $item . "+'", $url);
    }

    /**
     * Check if App::environment is IMET related (ex. imetoffline or imetglobal)
     *
     * @return bool|string
     */
    function is_imet_environment(){
        return App::environment('imetoffline')
            || App::environment('imetglobal');
    }
}
