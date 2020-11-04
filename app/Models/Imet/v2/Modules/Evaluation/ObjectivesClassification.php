<?php

namespace App\Models\Imet\v2\Modules\Evaluation;


class ObjectivesClassification extends _Objectives
{ 
    protected $table = 'imet.eval_objectives_c12';
    
    public function __construct(array $attributes = [])
    {
        $this->module_code = 'C1.1';
        $this->module_info = trans('form/imet/v2/evaluation.ObjectivesClassification.module_info');
        
        parent::__construct($attributes);
    }
}