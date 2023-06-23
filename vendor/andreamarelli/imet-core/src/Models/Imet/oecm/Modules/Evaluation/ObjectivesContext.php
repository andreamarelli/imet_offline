<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\_Objectives;
use AndreaMarelli\ImetCore\Models\User\Role;

class ObjectivesContext extends _Objectives
{
    protected $table = 'imet_oecm.eval_objectives_context';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'CX';
        $this->module_info = trans('imet-core::oecm_evaluation.ObjectivesContext.module_info');

        parent::__construct($attributes);
    }
}
