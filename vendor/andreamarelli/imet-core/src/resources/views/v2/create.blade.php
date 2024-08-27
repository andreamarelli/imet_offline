<?php
/** @var bool $is_wdpa */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Create;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\CreateNonWdpa;

$is_wdpa = $is_wdpa ?? true;

?>

@extends('modular-forms::page.create', [
    'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v2\ContextController::class,
    'module' => $is_wdpa
        ? Create::class
        : CreateNonWdpa::class
])