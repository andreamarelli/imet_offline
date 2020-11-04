<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ObjectivesHabitats extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_objectives_c14';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'C1.4';
        $this->module_title = trans('form/imet/v1/evaluation.ObjectivesHabitats.title');
        $this->module_fields = [
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesHabitats.fields.Status')],
            ['name' => 'Benchmark1',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesHabitats.fields.Benchmark1')],
            ['name' => 'Benchmark2',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesHabitats.fields.Benchmark2')],
            ['name' => 'Benchmark3',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesHabitats.fields.Benchmark3')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesHabitats.fields.Objective')],
        ];

        $this->module_info = trans('form/imet/v1/evaluation.ObjectivesHabitats.module_info');
        
        parent::__construct($attributes);
     
    }
}