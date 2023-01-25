<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\User\Role;

class ObjectivesIntrants extends _Objectives
{
    protected $table = 'imet.eval_objectives_intrants';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'IX';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesIntrants.module_info');

        parent::__construct($attributes);
    }
}
