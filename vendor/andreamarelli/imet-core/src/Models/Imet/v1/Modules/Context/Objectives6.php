<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

class Objectives6 extends _Objectives
{
    protected $table = 'imet.context_objectives6';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 6.3';
        $this->module_info = trans('imet-core::v1_context.Objectives6.module_info');

        parent::__construct($attributes);

    }
}
