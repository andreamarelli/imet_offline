<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

class Objectives4 extends _Objectives
{
    protected $table = 'imet.context_objectives4';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 4.6';
        $this->module_info = trans('imet-core::v1_context.Objectives4.module_info');

        parent::__construct($attributes);

    }
}
