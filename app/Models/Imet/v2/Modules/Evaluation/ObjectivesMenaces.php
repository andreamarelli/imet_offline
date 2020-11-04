<?php

namespace App\Models\Imet\v2\Modules\Evaluation;


class ObjectivesMenaces extends _Objectives
{ 
    protected $table = 'imet.eval_objectives_c3';
    
    public function __construct(array $attributes = [])
    {
        $this->module_code = 'C3';
        $this->module_info = trans('form/imet/v2/evaluation.ObjectivesMenaces.module_info');
        
        parent::__construct($attributes);
    }
}