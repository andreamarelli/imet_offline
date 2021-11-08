<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


class ObjectivesProcessus extends _Objectives
{
    protected $table = 'imet.eval_objectives_processus';

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'PRX';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesProcessus.module_info');

        parent::__construct($attributes);
    }
}
