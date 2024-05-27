<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;

class Objectives6 extends _Objectives
{
    protected $table = 'context_objectives6';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 6.2';
        $this->module_info = trans('imet-core::v2_context.Objectives6.module_info');

        parent::__construct($attributes);

    }
}
