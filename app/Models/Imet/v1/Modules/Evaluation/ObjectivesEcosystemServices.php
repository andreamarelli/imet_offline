<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class ObjectivesEcosystemServices extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_objectives_c16';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'C1.6';
        $this->module_title = trans('form/imet/v1/evaluation.ObjectivesEcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesEcosystemServices.fields.Status')],
            ['name' => 'Benchmark1',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesEcosystemServices.fields.Benchmark1')],
            ['name' => 'Benchmark2',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesEcosystemServices.fields.Benchmark2')],
            ['name' => 'Benchmark3',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesEcosystemServices.fields.Benchmark3')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.ObjectivesEcosystemServices.fields.Objective')],
        ];

        $this->module_info = trans('form/imet/v1/evaluation.ObjectivesEcosystemServices.module_info');
        
        parent::__construct($attributes);
     
    }
}