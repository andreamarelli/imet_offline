<?php

namespace App\Models\Imet\v2\Modules\Evaluation;


class ObjectivesClimateChange extends _Objectives
{ 
    protected $table = 'imet.eval_objectives_c15';
    
    public function __construct(array $attributes = [])
    {
        $this->module_code = 'C1.4';
        $this->module_info = trans('form/imet/v2/evaluation.ObjectivesClimateChange.module_info');
        
        parent::__construct($attributes);
    }
}