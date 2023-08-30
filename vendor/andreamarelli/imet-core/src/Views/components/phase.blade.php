<?php
use \AndreaMarelli\ImetCore\Controllers;
use \AndreaMarelli\ImetCore\Models\Imet\Imet;
use \Illuminate\Support\Facades\Route;
use \Illuminate\Support\Str;

/** @var Imet $item */
/** @var string $phase */

$route_action = Str::endsWith(Route::currentRouteName(), 'show') ? 'show' : 'edit';

if($item->version===Imet::IMET_V1){
    $ROUTE_PREFIX = Controllers\Imet\v1\Controller::ROUTE_PREFIX;
} elseif($item->version===Imet::IMET_V2){
    $ROUTE_PREFIX = Controllers\Imet\v2\Controller::ROUTE_PREFIX;
} elseif($item->version===Imet::IMET_OECM){
    $ROUTE_PREFIX = Controllers\Imet\oecm\Controller::ROUTE_PREFIX;
}

?>

<nav class="steps">

    <a href="{{ route($ROUTE_PREFIX.'context_' . $route_action, [$item->getKey()]) }}"
       class="step @if('context'==$phase) selected @endif"
    >@uclang('imet-core::common.context_long')</a>

    <a href="{{ route($ROUTE_PREFIX.'eval_' . $route_action, [$item->getKey()]) }}"
       class="step @if('evaluation'==$phase) selected @endif"
    >@uclang('imet-core::common.evaluation_long')</a>

    <a href="{{ route($ROUTE_PREFIX.'report_' . $route_action, [$item->getKey()]) }}"
       class="step @if('report'==$phase) selected @endif"
    >@uclang('imet-core::common.report_long')</a>

</nav>