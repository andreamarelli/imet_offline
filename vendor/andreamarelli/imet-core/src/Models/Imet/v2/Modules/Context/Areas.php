<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Helpers\Template;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Areas extends Modules\Component\ImetModule
{
    protected $table = 'context_areas';
    public $label_width = 5;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {
        $this->module_type   = 'SIMPLE';
        $this->module_code   = 'CTX 2.2';
        $this->module_title  = trans('imet-core::v2_context.Areas.title');
        $this->module_fields = [
            [
                'name' => 'AdministrativeArea',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.AdministrativeArea')
            ],
            [
                'name' => 'WDPAArea',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.WDPAArea')],
            [
                'name' => 'GISArea',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.GISArea')
            ],
            [
                'name' => 'BoundaryLength',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.BoundaryLength')
            ],
            [
                'name' => 'TerrestrialArea',
                'type' => 'numeric',
                'label' => Template::module_scope(static::TERRESTRIAL).trans('imet-core::v2_context.Areas.fields.TerrestrialArea')
            ],
            [
                'name' => 'MarineArea',
                'type' => 'numeric',
                'label' => Template::module_scope(static::MARINE).trans('imet-core::v2_context.Areas.fields.MarineArea')
            ],
            [
                'name' => 'PercentageNationalNetwork',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.PercentageNationalNetwork')
            ],
            [
                'name' => 'PercentageEcoregion',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.PercentageEcoregion')
            ],
            [
                'name' => 'PercentageTransnationalNetwork',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.PercentageTransnationalNetwork')
            ],
            [
                'name' => 'PercentageLandscapeNetwork',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.PercentageLandscapeNetwork')
            ],
            [
                'name' => 'Index',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.Index')
            ],
        ];

        $this->module_common_fields = [
            [
                'name' => 'Observations',
                'type' => 'text-area',
                'label' => trans('imet-core::v2_context.Areas.fields.Observations')
            ],
        ];

        parent::__construct($attributes);
    }

    public static function getArea($form_id)
    {
        $areas = static::getModuleRecords($form_id)['records'];
        $area  = 0;
        if (count($areas) > 0) {
            $area = null;
            $area = array_key_exists(
                'AdministrativeArea',
                $areas[0]
            ) && $areas[0]['AdministrativeArea'] !== null && $areas[0]['AdministrativeArea'] > 0 ? $areas[0]['AdministrativeArea'] : $area;
            $area = array_key_exists(
                'WDPAArea',
                $areas[0]
            ) && $areas[0]['WDPAArea'] !== null && $areas[0]['WDPAArea'] > 0 ? $areas[0]['WDPAArea'] : $area;
            $area = array_key_exists(
                'GISArea',
                $areas[0]
            ) && $areas[0]['GISArea'] !== null && $areas[0]['GISArea'] > 0 ? $areas[0]['GISArea'] : $area;
        }
        return $area === 0 ? null : $area / 100; // ha->km2
    }

}
