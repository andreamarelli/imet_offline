<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


class ObjectivesSupportsAndConstraints extends _Objectives
{
    protected $table = 'imet.eval_objectives_c2';

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'C2';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesSupportsAndConstraints.module_info');

        parent::__construct($attributes);
    }
}
