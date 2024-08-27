<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class ManagementRelativeImportance extends Modules\Component\ImetModule
{
    protected $table = 'context_management_relative_importance';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 3.1.1';
        $this->module_title = trans('imet-core::oecm_context.ManagementRelativeImportance.title');
        $this->module_fields = [
            ['name' => 'RelativeImportance',       'type' => 'rating-Minus3to3',   'label' => trans('imet-core::oecm_context.ManagementRelativeImportance.fields.RelativeImportance')],
        ];

        parent::__construct($attributes);
    }
}
