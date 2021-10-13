<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;


class Objectives1 extends _Objectives
{
    protected $table = 'imet.context_objectives1';

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 1.7';
        $this->module_info = trans('imet-core::v2_context.Objectives1.module_info');

        parent::__construct($attributes);

    }
}
