<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ObjectivesSupportsAndConstraints extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_objectives_c2';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'C2';
        $this->module_title = trans('form/imet/v1/evaluation.ObjectivesSupportsAndConstraints.title');
        $this->module_fields = [
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesSupportsAndConstraints.fields.Status')],
            ['name' => 'Benchmark1',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesSupportsAndConstraints.fields.Benchmark1')],
            ['name' => 'Benchmark2',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesSupportsAndConstraints.fields.Benchmark2')],
            ['name' => 'Benchmark3',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesSupportsAndConstraints.fields.Benchmark3')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesSupportsAndConstraints.fields.Objective')],
        ];

        $this->module_info = trans('form/imet/v1/evaluation.ObjectivesSupportsAndConstraints.module_info');

        parent::__construct($attributes);
     
    }
}