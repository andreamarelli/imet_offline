<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


class ObjectivesEcosystemServices extends _Objectives
{
    protected $table = 'imet.eval_objectives_c16';

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'C1.5';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesEcosystemServices.module_info');

        parent::__construct($attributes);
    }
}
