<?php

namespace App\Models\Imet\v2\Modules\Context;

class Objectives7 extends _Objectives
{
    protected $table = 'imet.context_objectives7';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 7.2';
        $this->module_info = trans('form/imet/v2/context.Objectives7.module_info');

        parent::__construct($attributes);

    }
}