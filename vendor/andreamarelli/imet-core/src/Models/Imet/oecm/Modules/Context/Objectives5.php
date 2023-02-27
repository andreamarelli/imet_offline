<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;

class Objectives5 extends _Objectives
{
    protected $table = 'imet_oecm.context_objectives5';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 5.2';
        $this->module_info = trans('imet-core::oecm_context.Objectives5.module_info');

        parent::__construct($attributes);

    }
}
