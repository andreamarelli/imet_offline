<?php
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */


$original_definitions = $definitions;

// First group: "Existence" hidden
$definitions['groups'] = array_slice($original_definitions['groups'], 0, 1);
unset($definitions['fields'][1]);
$first_group = View::make('modular-forms::module.show.type.group_table', compact(['collection', 'records', 'definitions']))->render();

// Second groups: standard
$definitions['groups'] = array_slice($original_definitions['groups'], 1);
$definitions['fields'] = $original_definitions['fields'];
$second_group = View::make('modular-forms::module.show.type.group_table', compact(['collection', 'records', 'definitions']))->render();

$dom = HtmlPageCrawler::create('<div>'.$first_group.$second_group.'</div>');

?>

{!! $dom->saveHTML() !!}