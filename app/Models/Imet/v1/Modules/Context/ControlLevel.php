<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class ControlLevel extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_control_level';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.3';
        $this->module_title = trans('form/imet/v1/context.ControlLevel.title');
        $this->module_fields = [
            ['name' => 'UnderControlArea',              'type' => 'integer',   'label' => trans('form/imet/v1/context.ControlLevel.fields.UnderControlArea')],
            ['name' => 'UnderControlPatrolManDay',      'type' => 'integer',   'label' => trans('form/imet/v1/context.ControlLevel.fields.UnderControlPatrolManDay')],
            ['name' => 'UnderControlPatrolKm',          'type' => 'integer',   'label' => trans('form/imet/v1/context.ControlLevel.fields.UnderControlPatrolKm')],
            ['name' => 'EcologicalMonitoringPatrolKm',  'type' => 'integer',   'label' => trans('form/imet/v1/context.ControlLevel.fields.EcologicalMonitoringPatrolKm')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ControlLevel.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.ControlLevel.fields.Observations')],
        ];

        parent::__construct($attributes);

    }
}