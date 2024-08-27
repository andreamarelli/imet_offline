<?php
/** @var String $controller */
/** @var \AndreaMarelli\ModularForms\Models\Module $module_class */
/** @var int $form_id */

$definitions = $module_class::getDefinitions();
?>

<div class="module-container" id="module_{{ $definitions['module_key'] }}">

    {{-- title --}}
    @include('modular-forms::module.title', compact(['definitions']))

    <div class="module-body">

        <div class="no-data">
            @uclang('imet-core::common.not_authorized_module')
        </div>

    </div>

</div>