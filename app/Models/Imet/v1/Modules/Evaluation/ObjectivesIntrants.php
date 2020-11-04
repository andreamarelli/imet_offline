<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ObjectivesIntrants extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_objectives_intrants';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'IX';
        $this->module_title = trans('form/imet/v1/evaluation.ObjectivesIntrants.title');
        $this->module_fields = [
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesIntrants.fields.Status')],
            ['name' => 'Benchmark1',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesIntrants.fields.Benchmark1')],
            ['name' => 'Benchmark2',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesIntrants.fields.Benchmark2')],
            ['name' => 'Benchmark3',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesIntrants.fields.Benchmark3')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesIntrants.fields.Objective')],
        ];

        $this->module_info = trans('form/imet/v1/evaluation.ObjectivesIntrants.module_info');
        
        parent::__construct($attributes);
     
    }
}