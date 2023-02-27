<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderAccessGovernance;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

$original_view = View::make('modular-forms::module.show.body', compact(['collection', 'records', 'definitions']))->render();

// Inject titles
$dom = HtmlPageCrawler::create('<div>'.$original_view.'</div>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group0')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title0'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group3')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title1'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group7')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title2'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group10')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title3'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group12')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title4'].'</h3>');

?>

{!! $dom->saveHTML() !!}