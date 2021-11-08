<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


class ObjectivesClimateChange extends _Objectives
{
    protected $table = 'imet.eval_objectives_c15';

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'C1.4';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesClimateChange.module_info');

        parent::__construct($attributes);
    }
}
