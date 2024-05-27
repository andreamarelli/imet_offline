<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\User\Role;

class ObjectivesSpecies extends _Objectives
{
    protected $table = 'eval_objectives_c13';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'CX1.2';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesSpecies.module_info');

        parent::__construct($attributes);
    }
}
