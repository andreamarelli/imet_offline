<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class _Objectives extends Modules\Component\ImetModule
{

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_title = trans('imet-core::v2_context.Objectives.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Objectives.fields.Element')],
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Objectives.fields.Status')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Objectives.fields.Objective')],
        ];

        $this->module_common_fields = [
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Objectives.fields.Comments')],
        ];

        parent::__construct($attributes);
    }

}
