<?php
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$original_definitions = $definitions;

// First group: nothing to change
$definitions['groups'] = array_slice($original_definitions['groups'], 0, 1);
$first_group = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vueData', 'definitions']))->render();

// Second groups: fixed rows
$definitions['groups'] = array_slice($original_definitions['groups'], 1);
$definitions['fields'][2]['type'] = 'rating-0to3WithNA';
$second_group = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vueData', 'definitions']))->render();

$dom = HtmlPageCrawler::create('<div>'.$first_group.$second_group.'</div>');

?>

{!! $dom->saveHTML() !!}

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
