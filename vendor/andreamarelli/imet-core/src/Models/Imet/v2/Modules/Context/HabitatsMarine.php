<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class HabitatsMarine extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_habitats_marine';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 4.3.2';
        $this->module_title = trans('imet-core::v2_context.HabitatsMarine.title');
        $this->module_fields = [
            ['name' => 'HabitatType',   'type' => 'text-area',   'label' => trans('imet-core::v2_context.HabitatsMarine.fields.HabitatType')],
            ['name' => 'Presence',      'type' => 'dropdown-ImetV2_MarineHabitatsPresence',   'label' => trans('imet-core::v2_context.HabitatsMarine.fields.Presence')],
            ['name' => 'Area',          'type' => 'numeric',   'label' => trans('imet-core::v2_context.HabitatsMarine.fields.Area')],
            ['name' => 'Fragmentation', 'type' => 'text-area',   'label' => trans('imet-core::v2_context.HabitatsMarine.fields.Fragmentation')],
            ['name' => 'Source',        'type' => 'text-area',   'label' => trans('imet-core::v2_context.HabitatsMarine.fields.Source')],
            ['name' => 'Description',   'type' => 'text-area',   'label' => trans('imet-core::v2_context.HabitatsMarine.fields.Description')],
        ];

        $this->predefined_values = [
            'field' => 'HabitatType',
            'values' => trans('imet-core::v2_context.HabitatsMarine.predefined_values')
        ];

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // #### not in predefined lists ####
        $record['Presence'] = static::dropIfValueNotInPredefinedList($record['Presence'], 'MarineHabitatsPresence');

        return $record;
    }

}
