<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\_Objectives;
use AndreaMarelli\ImetCore\Models\User\Role;

class ObjectivesPlanification extends _Objectives
{
    protected $table = 'imet_oecm.eval_objectives_planification';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'PX';
        $this->module_info = trans('imet-core::oecm_evaluation.ObjectivesPlanification.module_info');

        parent::__construct($attributes);
    }
}
