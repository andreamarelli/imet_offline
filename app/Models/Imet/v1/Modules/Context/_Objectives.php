<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class _Objectives extends Modules\Component\ImetModule
{

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_title = trans('form/imet/v1/context.Objectives.title');
        $this->module_fields = [
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Objectives.fields.Status')],
            ['name' => 'Benchmark1',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Objectives.fields.Benchmark1')],
            ['name' => 'Benchmark2',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Objectives.fields.Benchmark2')],
            ['name' => 'Benchmark3',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Objectives.fields.Benchmark3')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Objectives.fields.Objective')],
        ];

        parent::__construct($attributes);

    }
}