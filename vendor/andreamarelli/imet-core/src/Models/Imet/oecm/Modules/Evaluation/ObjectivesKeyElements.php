<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\_Objectives;
use AndreaMarelli\ImetCore\Models\User\Role;

class ObjectivesKeyElements extends _Objectives
{
    protected $table = 'imet_oecm.eval_objectives_key_elements';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'CX1';
        $this->module_info = trans('imet-core::oecm_evaluation.ObjectivesKeyElements.module_info');

        parent::__construct($attributes);
    }
}
