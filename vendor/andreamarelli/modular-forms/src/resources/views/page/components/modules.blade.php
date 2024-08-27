<?php
/** @var \AndreaMarelli\ModularForms\Controllers\Controller $controller */
/** @var \AndreaMarelli\ModularForms\Models\Form $item */
/** @var string $step */
/** @var string $mode "edit" or "show" */

?>

{{--  Modules (by step) --}}
@foreach($item::modulesByStep($step) as $module)

    <x-modular-forms::module.container
        :controller="$controller"
        :module="$module"
        :formId="$item->getKey()"
        :mode="$mode"
    ></x-modular-forms::module.container>

@endforeach
