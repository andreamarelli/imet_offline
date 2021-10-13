<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ObjectivesPlanification extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_objectives_planification';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PX';
        $this->module_title = trans('imet-core::v1_evaluation.ObjectivesPlanification.title');
        $this->module_fields = [
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesPlanification.fields.Status')],
            ['name' => 'Benchmark1',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesPlanification.fields.Benchmark1')],
            ['name' => 'Benchmark2',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesPlanification.fields.Benchmark2')],
            ['name' => 'Benchmark3',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesPlanification.fields.Benchmark3')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesPlanification.fields.Objective')],
        ];

        $this->module_info = trans('imet-core::v1_evaluation.ObjectivesPlanification.module_info');

        parent::__construct($attributes);

    }
}
