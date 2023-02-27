<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\_Objectives;
use AndreaMarelli\ImetCore\Models\User\Role;

class ObjectivesSupportsAndConstraints extends _Objectives
{
    protected $table = 'imet_oecm.eval_objectives_supports_and_contraints';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'CX2';
        $this->module_info = trans('imet-core::oecm_evaluation.ObjectivesSupportsAndConstraints.module_info');

        parent::__construct($attributes);
    }
}
