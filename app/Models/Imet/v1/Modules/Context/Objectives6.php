<?php

namespace App\Models\Imet\v1\Modules\Context;

class Objectives6 extends _Objectives
{
    protected $table = 'imet.context_objectives6';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 6.3';
        $this->module_info = trans('form/imet/v1/context.Objectives6.module_info');

        parent::__construct($attributes);

    }
}