<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class Sectors extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_sectors';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 2.4';
        $this->module_title = trans('form/imet/v1/context.Sectors.title');
        $this->module_fields = [
            ['name' => 'Name',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Sectors.fields.Name')],
            ['name' => 'UnderControlArea',  'type' => 'integer',   'label' => trans('form/imet/v1/context.Sectors.fields.UnderControlArea')],
            ['name' => 'UnderControlPatrolKm',  'type' => 'integer',   'label' => trans('form/imet/v1/context.Sectors.fields.UnderControlPatrolKm')],
            ['name' => 'UnderControlPatrolManDay',  'type' => 'integer',   'label' => trans('form/imet/v1/context.Sectors.fields.UnderControlPatrolManDay')],
            ['name' => 'Objectives',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Sectors.fields.Objectives')],
            ['name' => 'Restrictions',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Sectors.fields.Restrictions')],
        ];

        $this->module_common_fields = [
            ['name' => 'SectorMap',  'type' => 'upload',   'label' => trans('form/imet/v1/context.Sectors.fields.SectorMap')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Sectors.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.Sectors.fields.Observations')],
        ];

        parent::__construct($attributes);

    }
}