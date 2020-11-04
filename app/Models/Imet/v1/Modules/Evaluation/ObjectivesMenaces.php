<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ObjectivesMenaces extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_objectives_c3';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'C3';
        $this->module_title = trans('form/imet/v1/evaluation.ObjectivesMenaces.title');
        $this->module_fields = [
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesMenaces.fields.Status')],
            ['name' => 'Benchmark1',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesMenaces.fields.Benchmark1')],
            ['name' => 'Benchmark2',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesMenaces.fields.Benchmark2')],
            ['name' => 'Benchmark3',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesMenaces.fields.Benchmark3')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesMenaces.fields.Objective')],
        ];

        $this->module_info = trans('form/imet/v1/evaluation.ObjectivesMenaces.module_info');
        
        parent::__construct($attributes);
     
    }
}