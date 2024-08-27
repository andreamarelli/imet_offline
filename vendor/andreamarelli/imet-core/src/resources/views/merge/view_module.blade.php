<?php

use \AndreaMarelli\ImetCore\Controllers;
use \AndreaMarelli\ImetCore\Models;
use \AndreaMarelli\ModularForms\Enums\ModuleViewModes;

/** @var Controllers\Imet\v1\Controller|Controllers\Imet\v2\Controller|Controllers\Imet\oecm\Controller $controller */
/** @var integer $formID */
/** @var Models\Imet\v1\Modules\Component\ImetModule|Models\Imet\v2\Modules\Component\ImetModule $module */
/** @var Models\Imet\v1\Modules\Component\ImetModule|Models\Imet\v2\Modules\Component\ImetModule $module_class as String */

$modal_id = 'imet_'.$formID.'_'.$module_class::getShortClassName();
?>

<floating_dialog>

    <!-- anchor -->
    <template slot="dialog-anchor">
        <button type="button" class="btn-nav small">
            {!! AndreaMarelli\ModularForms\Helpers\Template::icon('eye', 'white') !!}
        </button>
        <tooltip>@uclang('modular-forms::common.show')</tooltip>
    </template>

    <!-- dialog -->
    <template slot="dialog-content">
        <div class="with_header_and_footer">

            <!-- dialog header -->
            <div class="header">
                IMET #{{ $formID }}
            </div>

            <!-- dialog body -->
            <div class="body text-center">
                <x-modular-forms::module.container
                        :controller="$controller"
                        :module="$module_class"
                        :formId="$formID"
                        :mode="ModuleViewModes::SHOW"
                ></x-modular-forms::module.container>
            </div>

        </div>
    </template>

</floating_dialog>
