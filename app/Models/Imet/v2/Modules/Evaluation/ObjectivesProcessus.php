<?php

namespace App\Models\Imet\v2\Modules\Evaluation;


class ObjectivesProcessus extends _Objectives
{ 
    protected $table = 'imet.eval_objectives_processus';
    
    public function __construct(array $attributes = [])
    {
        $this->module_code = 'PRX';
        $this->module_info = trans('form/imet/v2/evaluation.ObjectivesProcessus.module_info');
        
        parent::__construct($attributes);
    }
}