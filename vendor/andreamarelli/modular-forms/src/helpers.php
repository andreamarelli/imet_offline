<?php

/**
 * Generate action url with dummy item ID (Ex. /path/to/route/@DUMMY@/action_name)
 *
 * @param $controller
 * @param $action
 * @param $item
 * @return string
 */
function vueAction($controller, $action, $item): string
{
    $DUMMY_ITEM = '@DUMMY@';
    $url = action([$controller, $action], [$DUMMY_ITEM]);
    return str_replace($DUMMY_ITEM, "'+" . $item . "+'", $url);
}