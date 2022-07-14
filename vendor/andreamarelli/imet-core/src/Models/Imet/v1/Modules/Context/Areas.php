<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class Areas extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_areas';
    public $label_width = 5;

    public function __construct(array $attributes = [])
    {
        $this->module_type   = 'SIMPLE';
        $this->module_code   = 'CTX 2.2';
        $this->module_title  = trans('imet-core::v1_context.Areas.title');
        $this->module_fields = [
            [
                'name' => 'AdministrativeArea',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.AdministrativeArea')
            ],
            ['name' => 'WDPAArea', 'type' => 'integer', 'label' => trans('imet-core::v1_context.Areas.fields.WDPAArea')],
            ['name' => 'GISArea', 'type' => 'integer', 'label' => trans('imet-core::v1_context.Areas.fields.GISArea')],

            [
                'name' => 'TerrestrialArea',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.TerrestrialArea')
            ],
            [
                'name' => 'MarineArea',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.MarineArea')
            ],
            [
                'name' => 'PercentageNationalNetwork',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.PercentageNationalNetwork')
            ],
            [
                'name' => 'PercentageEcoregion',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.PercentageEcoregion')
            ],
            [
                'name' => 'PercentageTransnationalNetwork',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.PercentageTransnationalNetwork')
            ],
            [
                'name' => 'PercentageLandscapeNetwork',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.PercentageLandscapeNetwork')
            ],
            ['name' => 'Index', 'type' => 'text-area', 'label' => trans('imet-core::v1_context.Areas.fields.Index')],
        ];

        $this->module_common_fields = [
            [
                'name' => 'Observations',
                'type' => 'text-area',
                'label' => trans('imet-core::v1_context.Areas.fields.Observations')
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

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Areas',
            'fields' => [
                'AdministrativeArea', 'WDPAArea', 'GISArea', 'TerrestrialArea', 'MarineArea',
                'PercentageNationalNetwork', 'PercentageEcoregion', 'PercentageTransnationalNetwork', 'PercentageLandscapeNetwork', 'Index',
                'Observations'
            ]
        ];
    }

}
