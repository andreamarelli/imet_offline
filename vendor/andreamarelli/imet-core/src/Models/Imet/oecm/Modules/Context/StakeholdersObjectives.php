<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class StakeholdersObjectives extends _Objectives
{
    protected $table = 'context_stakeholders_objectives';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_code = 'SA 1.2';
        $this->module_info = trans('imet-core::oecm_context.StakeholdersObjectives.module_info');

        parent::__construct($attributes);

    }
}
