<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class HabitatsMarine extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_habitats_marine';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 4.3.2';
        $this->module_title = trans('form/imet/v1/context.HabitatsMarine.title');
        $this->module_fields = [
            ['name' => 'HabitatType',   'type' => 'text-area',   'label' => trans('form/imet/v1/context.HabitatsMarine.fields.HabitatType')],
            ['name' => 'Presence',      'type' => 'dropdown-ImetV1_MarineHabitatsPresence',   'label' => trans('form/imet/v1/context.HabitatsMarine.fields.Presence')],
            ['name' => 'Area',          'type' => 'integer',   'label' => trans('form/imet/v1/context.HabitatsMarine.fields.Area')],
            ['name' => 'Fragmentation', 'type' => 'text-area',   'label' => trans('form/imet/v1/context.HabitatsMarine.fields.Fragmentation')],
            ['name' => 'Source',        'type' => 'text-area',   'label' => trans('form/imet/v1/context.HabitatsMarine.fields.Source')],
            ['name' => 'Description',   'type' => 'text-area',   'label' => trans('form/imet/v1/context.HabitatsMarine.fields.Description')],
        ];

        $this->predefined_values = [
            'field' => 'HabitatType',
            'values' => trans('form/imet/v1/context.HabitatsMarine.predefined_values')
        ];

        $this->module_info = trans('form/imet/v1/context.HabitatsMarine.module_info');

        parent::__construct($attributes);

    }
}