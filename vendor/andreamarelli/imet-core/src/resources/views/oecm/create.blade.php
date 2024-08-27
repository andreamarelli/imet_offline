<?php
/** @var bool $is_wdpa */

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Create;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\CreateNonWdpa;

$is_wdpa = $is_wdpa ?? true;
?>

@extends('modular-forms::page.create', [
    'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\oecm\ContextController::class,
    'module' => $is_wdpa
        ? Create::class
        : CreateNonWdpa::class
])
