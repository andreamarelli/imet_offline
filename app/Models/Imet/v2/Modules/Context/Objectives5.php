<?php

namespace App\Models\Imet\v2\Modules\Context;

class Objectives5 extends _Objectives
{
    protected $table = 'imet.context_objectives5';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 5.2';
        $this->module_info = trans('form/imet/v2/context.Objectives5.module_info');

        parent::__construct($attributes);

    }
}