<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class Sectors extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_sectors';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 2.4';
        $this->module_title = trans('imet-core::v1_context.Sectors.title');
        $this->module_fields = [
            ['name' => 'Name',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Sectors.fields.Name')],
            ['name' => 'UnderControlArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.Sectors.fields.UnderControlArea')],
            ['name' => 'UnderControlPatrolKm',  'type' => 'integer',   'label' => trans('imet-core::v1_context.Sectors.fields.UnderControlPatrolKm')],
            ['name' => 'UnderControlPatrolManDay',  'type' => 'integer',   'label' => trans('imet-core::v1_context.Sectors.fields.UnderControlPatrolManDay')],
            ['name' => 'Objectives',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Sectors.fields.Objectives')],
            ['name' => 'Restrictions',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Sectors.fields.Restrictions')],
        ];

        $this->module_common_fields = [
            ['name' => 'SectorMap',  'type' => 'upload',   'label' => trans('imet-core::v1_context.Sectors.fields.SectorMap')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Sectors.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Sectors.fields.Observations')],
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
            'table' => 'Sectors',
            'fields' => [
                'Name', 'UnderControlArea', 'UnderControlPatrolKm', 'UnderControlPatrolManDay', 'Objectives', 'Restrictions',
                'SectorMap','Source','Observations'
            ]
        ];
    }
}
