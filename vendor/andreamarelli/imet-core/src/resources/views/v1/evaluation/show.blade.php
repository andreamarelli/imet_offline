<?php

/** @var \AndreaMarelli\ImetCore\Controllers\Imet\v1\EvalController $controller */
/** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet $item */
/** @var string $step */

?>

@extends('imet-core::page.show', [
    'controller' => $controller,
    'item' => $item,
    'step' => $step
])
