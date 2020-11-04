<?php

namespace App\Models\Imet\v1\Modules\Context;

class Objectives3 extends _Objectives
{
    protected $table = 'imet.context_objectives3';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 3.4';
        $this->module_info = trans('form/imet/v1/context.Objectives3.module_info');

        parent::__construct($attributes);

    }
}