<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

class Objectives5 extends _Objectives
{
    protected $table = 'imet.context_objectives5';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 5.2';
        $this->module_info = trans('imet-core::v1_context.Objectives5.module_info');

        parent::__construct($attributes);

    }
}
