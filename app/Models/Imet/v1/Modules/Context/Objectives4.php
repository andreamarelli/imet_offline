<?php

namespace App\Models\Imet\v1\Modules\Context;

class Objectives4 extends _Objectives
{
    protected $table = 'imet.context_objectives4';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 4.6';
        $this->module_info = trans('form/imet/v1/context.Objectives4.module_info');

        parent::__construct($attributes);

    }
}