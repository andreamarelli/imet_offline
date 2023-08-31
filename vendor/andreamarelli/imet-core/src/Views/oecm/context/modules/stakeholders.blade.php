<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

$original_view = View::make('modular-forms::module.edit.body', compact(['collection', 'vue_data', 'definitions']))->render();

$dom = HtmlPageCrawler::create('<div>'.$original_view.'</div>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group0')->before('<h3 style="margin-bottom: 20px;">'.trans('imet-core::oecm_context.Stakeholders.titles.title0').'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group5')->before('<h3 style="margin-bottom: 20px;">'.trans('imet-core::oecm_context.Stakeholders.titles.title1').'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group7')->before('<h3 style="margin-bottom: 20px;">'.trans('imet-core::oecm_context.Stakeholders.titles.title2').'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group9')->before('<h3 style="margin-bottom: 20px;">'.trans('imet-core::oecm_context.Stakeholders.titles.title3').'</h3>');

?>

{!! $dom->saveHTML() !!}

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))