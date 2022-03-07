<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ControlLevel extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_control_level';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.3';
        $this->module_title = trans('imet-core::v1_context.ControlLevel.title');
        $this->module_fields = [
            ['name' => 'UnderControlArea',              'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.UnderControlArea')],
            ['name' => 'UnderControlPatrolManDay',      'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.UnderControlPatrolManDay')],
            ['name' => 'UnderControlPatrolKm',          'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.UnderControlPatrolKm')],
            ['name' => 'EcologicalMonitoringPatrolKm',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.EcologicalMonitoringPatrolKm')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ControlLevel.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ControlLevel.fields.Observations')],
        ];

        parent::__construct($attributes);

    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'ControlLevel',
            'fields' => [
                'UnderControlArea', 'UnderControlPatrolManDay', 'UnderControlPatrolKm', 'EcologicalMonitoringPatrolKm',
                'Source','Observations'
            ]
        ];
    }
}
