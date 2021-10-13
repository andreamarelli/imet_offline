<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

class Objectives2 extends _Objectives
{
    protected $table = 'imet.context_objectives2';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 2.5';
        $this->module_info = trans('imet-core::v2_context.Objectives2.module_info');

        parent::__construct($attributes);

    }
}
