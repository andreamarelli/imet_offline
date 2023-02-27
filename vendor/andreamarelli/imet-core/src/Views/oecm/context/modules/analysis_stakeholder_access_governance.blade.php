<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderAccessGovernance;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

$original_definitions = $definitions;

// First 3 groups: force "fixed_rows" and "Element" type as disabled
$definitions['groups'] = array_slice($definitions['groups'], 0, 3);
$definitions['fixed_rows'] = true;
$definitions['fields'][0]['type'] = 'disabled';
$first_groups = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

// Other groups: normal
$definitions = $original_definitions;
$definitions['groups'] = array_slice($definitions['groups'], 3);
$other_groups = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

// Inject titles
$dom = HtmlPageCrawler::create('<div>'.$first_groups.$other_groups.'</div>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group0')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title0'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group3')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title1'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group7')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title2'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group10')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title3'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group12')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title4'].'</h3>');

?>

{!! $dom->saveHTML() !!}

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))