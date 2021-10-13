<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


class ObjectivesPlanification extends _Objectives
{
    protected $table = 'imet.eval_objectives_planification';

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'PX';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesPlanification.module_info');

        parent::__construct($attributes);
    }
}
