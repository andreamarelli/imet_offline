<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class Objectives4 extends _Objectives
{
    protected $table = 'imet_oecm.context_objectives4';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 4.4';
        $this->module_info = trans('imet-core::oecm_context.Objectives4.module_info');

        parent::__construct($attributes);

    }
}
