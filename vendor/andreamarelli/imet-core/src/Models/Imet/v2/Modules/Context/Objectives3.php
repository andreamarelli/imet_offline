<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

class Objectives3 extends _Objectives
{
    protected $table = 'imet.context_objectives3';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 3.4';
        $this->module_info = trans('imet-core::v2_context.Objectives3.module_info');

        parent::__construct($attributes);

    }
}
