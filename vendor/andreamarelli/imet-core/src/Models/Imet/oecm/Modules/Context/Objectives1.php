<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class Objectives1 extends _Objectives
{
    protected $table = 'context_objectives1';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 1.7';
        $this->module_info = trans('imet-core::oecm_context.Objectives1.module_info');

        parent::__construct($attributes);

    }
}
