<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class HabitatsMarine extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_habitats_marine';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 4.3.2';
        $this->module_title = trans('imet-core::v1_context.HabitatsMarine.title');
        $this->module_fields = [
            ['name' => 'HabitatType',   'type' => 'text-area',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.HabitatType')],
            ['name' => 'Presence',      'type' => 'dropdown-ImetV1_MarineHabitatsPresence',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Presence')],
            ['name' => 'Area',          'type' => 'integer',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Area')],
            ['name' => 'Fragmentation', 'type' => 'text-area',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Fragmentation')],
            ['name' => 'Source',        'type' => 'text-area',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Source')],
            ['name' => 'Description',   'type' => 'text-area',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Description')],
        ];

        $this->predefined_values = [
            'field' => 'HabitatType',
            'values' => trans('imet-core::v1_context.HabitatsMarine.predefined_values')
        ];

        $this->module_info = trans('imet-core::v1_context.HabitatsMarine.module_info');

        parent::__construct($attributes);

    }
}
