<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class GeographicalLocation extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_localization';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.1';
        $this->module_title = trans('imet-core::v1_context.GeographicalLocation.title');
        $this->module_fields = [
            ['name' => 'LimitsExist',  'type' => 'toggle-yes_no',   'label' => trans('imet-core::v1_context.GeographicalLocation.fields.LimitsExist')],
            ['name' => 'Shapefile',  'type' => 'upload',   'label' => trans('imet-core::v1_context.GeographicalLocation.fields.Shapefile')],
            ['name' => 'SourceSHP',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeographicalLocation.fields.SourceSHP')],
            ['name' => 'Coordinates',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeographicalLocation.fields.Coordinates')],
            ['name' => 'SourceCoords',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeographicalLocation.fields.SourceCoords')],
            ['name' => 'AdministrativeLocation',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.GeographicalLocation.fields.AdministrativeLocation')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Localization',
            'fields' => [
                'LimitsExist', 'Shapefile', 'SourceSHP', 'Coordinates', 'SourceCoords', 'AdministrativeLocation'
            ]
        ];
    }
}
