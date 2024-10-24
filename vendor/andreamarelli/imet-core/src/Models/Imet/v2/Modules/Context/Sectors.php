<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Sectors extends Modules\Component\ImetModule
{
    protected $table = 'context_sectors';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 2.3';
        $this->module_title = trans('imet-core::v2_context.Sectors.title');
        $this->module_fields = [
            ['name' => 'Name',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Sectors.fields.Name')],
            ['name' => 'TerrestrialOrMarine',  'type' => 'dropdown-ImetV2_TerrestrialOrMarine',   'label' => trans('imet-core::v2_context.Sectors.fields.TerrestrialOrMarine')],
            ['name' => 'UnderControlArea',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.Sectors.fields.UnderControlArea')],
            ['name' => 'UnderControlPatrolKm',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.Sectors.fields.UnderControlPatrolKm')],
            ['name' => 'UnderControlPatrolManDay',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.Sectors.fields.UnderControlPatrolManDay')],
        ];

        $this->module_common_fields = [
            ['name' => 'SectorMap',  'type' => 'upload',   'label' => trans('imet-core::v2_context.Sectors.fields.SectorMap')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Sectors.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Sectors.fields.Observations')],
        ];

        $this->module_info = trans('imet-core::v2_context.Sectors.module_info');

        parent::__construct($attributes);
    }

}
