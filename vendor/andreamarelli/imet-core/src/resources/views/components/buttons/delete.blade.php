<?php
use AndreaMarelli\ImetCore\Controllers;
use AndreaMarelli\ImetCore\Models;
use AndreaMarelli\ModularForms\Helpers\Template;

/** @var int|Models\Imet\v2\Imet|Models\Imet\v1\Imet|Models\Imet\oecm\Imet|Models\Imet\v2\Imet_Eval|Models\Imet\v1\Imet_Eval|Models\Imet\oecm\Imet_Eval $item */
/** @var String $version */

if($version === Models\Imet\Imet::IMET_V1){
    $controller = Controllers\Imet\v1\Controller::class;
} else if($version === Models\Imet\Imet::IMET_V2){
    $controller = Controllers\Imet\v2\Controller::class;
} else {
    $controller = Controllers\Imet\oecm\Controller::class;
}

?>

<x-modular-forms::button.form.destroy
        :controller="$controller"
        :item="$item"
></x-modular-forms::button.form.destroy>