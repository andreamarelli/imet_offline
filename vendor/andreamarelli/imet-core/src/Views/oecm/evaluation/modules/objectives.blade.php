<?php
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$original_definitions = $definitions;

// First group: "Existence" hidden
$definitions['groups'] = array_slice($original_definitions['groups'], 0, 1);
$definitions['fields'][1]['type'] = 'hidden';
$first_group = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

// Second groups: fixed rows
$definitions['groups'] = array_slice($original_definitions['groups'], 1);
$definitions['fields'][1]['type'] = $original_definitions['fields'][1]['type'];
$definitions['fixed_rows'] = true;
$second_group = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

$dom = HtmlPageCrawler::create('<div>'.$first_group.$second_group.'</div>');

?>

{!! $dom->saveHTML() !!}

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))
