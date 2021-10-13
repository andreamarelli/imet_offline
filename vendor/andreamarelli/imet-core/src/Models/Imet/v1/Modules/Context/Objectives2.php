<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

class Objectives2 extends _Objectives
{
    protected $table = 'imet.context_objectives2';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 2.6';
        $this->module_info = trans('imet-core::v1_context.Objectives2.module_info');

        parent::__construct($attributes);

    }
}
