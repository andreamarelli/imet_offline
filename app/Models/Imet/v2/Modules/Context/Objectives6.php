<?php

namespace App\Models\Imet\v2\Modules\Context;

class Objectives6 extends _Objectives
{
    protected $table = 'imet.context_objectives6';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 6.2';
        $this->module_info = trans('form/imet/v2/context.Objectives6.module_info');

        parent::__construct($attributes);

    }
}