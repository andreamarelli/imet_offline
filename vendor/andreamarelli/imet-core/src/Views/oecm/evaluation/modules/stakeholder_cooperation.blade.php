<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\StakeholderCooperation;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

$view_groups = View::make('imet-core::components.module.edit.group_with_nothing_to_evaluate', compact(['collection', 'vue_data', 'definitions']))->render();

// Inject titles
$dom = HtmlPageCrawler::create('<div>'.$view_groups.'</div>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group0')->before('<h3 style="margin-bottom: 20px;">'.(new StakeholderCooperation())->titles['title0'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group5')->before('<h3 style="margin-bottom: 20px;">'.(new StakeholderCooperation())->titles['title1'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group7')->before('<h3 style="margin-bottom: 20px;">'.(new StakeholderCooperation())->titles['title2'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group9')->before('<h3 style="margin-bottom: 20px;">'.(new StakeholderCooperation())->titles['title3'].'</h3>');


?>

{!! $dom->saveHTML() !!}

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))