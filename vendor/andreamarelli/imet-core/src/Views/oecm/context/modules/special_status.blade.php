<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Component\ImetModule;
use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\SpecialStatus;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

$original_view = View::make('modular-forms::module.edit.body', compact(['collection', 'vue_data', 'definitions']))->render();

$view = ImetModule::injectIconToGroups($original_view, SpecialStatus::get_marine_groups(), []);

?>

{!! $view !!}

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))

