<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\User\Role;

class ObjectivesProcessus extends _Objectives
{
    protected $table = 'eval_objectives_processus';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'PRX';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesProcessus.module_info');

        parent::__construct($attributes);
    }
}
