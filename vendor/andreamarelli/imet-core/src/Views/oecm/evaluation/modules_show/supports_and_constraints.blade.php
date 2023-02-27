<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraints;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

$view_groups = View::make('imet-core::components.module.show.group_with_nothing_to_evaluate', compact(['collection', 'records', 'definitions']))->render();

$dom = HtmlPageCrawler::create('<div>'.$view_groups.'</div>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group0')->before('<h3 style="margin-bottom: 20px;">'.(new SupportsAndConstraints())->titles['title0'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group5')->before('<h3 style="margin-bottom: 20px;">'.(new SupportsAndConstraints())->titles['title1'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group7')->before('<h3 style="margin-bottom: 20px;">'.(new SupportsAndConstraints())->titles['title2'].'</h3>');
$dom->filter('h5.group_title_'.$definitions['module_key'].'_group9')->before('<h3 style="margin-bottom: 20px;">'.(new SupportsAndConstraints())->titles['title3'].'</h3>');

?>

{!! $dom->saveHTML() !!}
