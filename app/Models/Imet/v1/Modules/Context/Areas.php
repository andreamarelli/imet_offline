<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class Areas extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_areas';
    public $label_width = 5;

    public function __construct(array $attributes = [])
    {
        $this->module_type   = 'SIMPLE';
        $this->module_code   = 'CTX 2.2';
        $this->module_title  = trans('form/imet/v1/context.Areas.title');
        $this->module_fields = [
            [
                'name' => 'AdministrativeArea',
                'type' => 'integer',
                'label' => trans('form/imet/v1/context.Areas.fields.AdministrativeArea')
            ],
            ['name' => 'WDPAArea', 'type' => 'integer', 'label' => trans('form/imet/v1/context.Areas.fields.WDPAArea')],
            ['name' => 'GISArea', 'type' => 'integer', 'label' => trans('form/imet/v1/context.Areas.fields.GISArea')],

            [
                'name' => 'TerrestrialArea',
                'type' => 'integer',
                'label' => trans('form/imet/v1/context.Areas.fields.TerrestrialArea')
            ],
            [
                'name' => 'MarineArea',
                'type' => 'integer',
                'label' => trans('form/imet/v1/context.Areas.fields.MarineArea')
            ],
            [
                'name' => 'PercentageNationalNetwork',
                'type' => 'integer',
                'label' => trans('form/imet/v1/context.Areas.fields.PercentageNationalNetwork')
            ],
            [
                'name' => 'PercentageEcoregion',
                'type' => 'integer',
                'label' => trans('form/imet/v1/context.Areas.fields.PercentageEcoregion')
            ],
            [
                'name' => 'PercentageTransnationalNetwork',
                'type' => 'integer',
                'label' => trans('form/imet/v1/context.Areas.fields.PercentageTransnationalNetwork')
            ],
            [
                'name' => 'PercentageLandscapeNetwork',
                'type' => 'integer',
                'label' => trans('form/imet/v1/context.Areas.fields.PercentageLandscapeNetwork')
            ],
            ['name' => 'Index', 'type' => 'text-area', 'label' => trans('form/imet/v1/context.Areas.fields.Index')],
        ];

        $this->module_common_fields = [
            [
                'name' => 'Observations',
                'type' => 'text-area',
                'label' => trans('form/imet/v1/context.Areas.fields.Observations')
            ],
        ];

        parent::__construct($attributes);
    }

    public static function getArea($form_id)
    {
        $areas = static::getModuleRecords($form_id)['records'];
        $area  = 0;
        if (count($areas) > 0 && array_key_exists('AdministrativeArea', $areas[0])) {
            $area = $areas[0]['AdministrativeArea'];
        }
        return $area === 0 ? null : $area / 100; // ha->km2
    }

}