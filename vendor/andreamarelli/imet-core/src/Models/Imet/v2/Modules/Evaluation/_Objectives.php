<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class _Objectives extends Modules\Component\ImetModule
{

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_title = trans('imet-core::v2_evaluation._Objectives.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation._Objectives.fields.Element')],
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation._Objectives.fields.Status')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation._Objectives.fields.Objective')],
        ];

        $this->module_common_fields = [
            ['name' => 'comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation._Objectives.fields.comments')],
        ];

        parent::__construct($attributes);
    }

}
