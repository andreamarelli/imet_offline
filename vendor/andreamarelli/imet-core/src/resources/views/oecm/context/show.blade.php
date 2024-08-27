<?php

/** @var \AndreaMarelli\ImetCore\Controllers\Imet\oecm\ContextController $controller */
/** @var \AndreaMarelli\ImetCore\Models\Imet\oecm\Imet $item */
/** @var string $step */

?>

@extends('imet-core::page.show', [
    'controller' => $controller,
    'item' => $item,
    'step' => $step
])
