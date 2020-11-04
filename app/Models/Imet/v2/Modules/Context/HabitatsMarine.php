<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\v2\Modules;

class HabitatsMarine extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_habitats_marine';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 4.3.2';
        $this->module_title = trans('form/imet/v2/context.HabitatsMarine.title');
        $this->module_fields = [
            ['name' => 'HabitatType',   'type' => 'text-area',   'label' => trans('form/imet/v2/context.HabitatsMarine.fields.HabitatType')],
            ['name' => 'Presence',      'type' => 'dropdown-ImetV2_MarineHabitatsPresence',   'label' => trans('form/imet/v2/context.HabitatsMarine.fields.Presence')],
            ['name' => 'Area',          'type' => 'numeric',   'label' => trans('form/imet/v2/context.HabitatsMarine.fields.Area')],
            ['name' => 'Fragmentation', 'type' => 'text-area',   'label' => trans('form/imet/v2/context.HabitatsMarine.fields.Fragmentation')],
            ['name' => 'Source',        'type' => 'text-area',   'label' => trans('form/imet/v2/context.HabitatsMarine.fields.Source')],
            ['name' => 'Description',   'type' => 'text-area',   'label' => trans('form/imet/v2/context.HabitatsMarine.fields.Description')],
        ];

        $this->predefined_values = [
            'field' => 'HabitatType',
            'values' => trans('form/imet/v2/context.HabitatsMarine.predefined_values')
        ];

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::replacePredefinedValue($record, 'HabitatType', 'Barrière coralliènne', 'Barrière corallienne');
        }
        // #### not in predefined lists ####
        $record['Presence'] = static::dropIfValueNotInPredefinedList($record['Presence'], 'MarineHabitatsPresence');

        return $record;
    }

}