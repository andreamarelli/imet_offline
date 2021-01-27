<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\v2\Modules;

class Sectors extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_sectors';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 2.3';
        $this->module_title = trans('form/imet/v2/context.Sectors.title');
        $this->module_fields = [
            ['name' => 'Name',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Sectors.fields.Name')],
            ['name' => 'UnderControlArea',  'type' => 'numeric',   'label' => trans('form/imet/v2/context.Sectors.fields.UnderControlArea')],
            ['name' => 'UnderControlPatrolKm',  'type' => 'numeric',   'label' => trans('form/imet/v2/context.Sectors.fields.UnderControlPatrolKm')],
            ['name' => 'UnderControlPatrolManDay',  'type' => 'numeric',   'label' => trans('form/imet/v2/context.Sectors.fields.UnderControlPatrolManDay')],
        ];

        $this->module_common_fields = [
            ['name' => 'SectorMap',  'type' => 'upload',   'label' => trans('form/imet/v2/context.Sectors.fields.SectorMap')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Sectors.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Sectors.fields.Observations')],
        ];

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::dropField($record, 'Objectives');
            $record = static::dropField($record, 'Restrictions');
        }

        return $record;
    }

}
