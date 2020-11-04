<?php

namespace App\Models\Imet\v2\Modules\Evaluation;


class ObjectivesHabitats extends _Objectives
{ 
    protected $table = 'imet.eval_objectives_c14';
    
    public function __construct(array $attributes = [])
    {
        $this->module_code = 'C1.3';
        $this->module_info = trans('form/imet/v2/evaluation.ObjectivesHabitats.module_info');
        
        parent::__construct($attributes);
    }
}