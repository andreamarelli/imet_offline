<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class GeographicalLocation extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_localization';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.1';
        $this->module_title = trans('imet-core::v2_context.GeographicalLocation.title');
        $this->module_fields = [
            ['name' => 'LimitsExist',  'type' => 'toggle-yes_no',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.LimitsExist')],
            ['name' => 'Shapefile',  'type' => 'upload',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.Shapefile')],
            ['name' => 'SourceSHP',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.SourceSHP')],
            ['name' => 'Coordinates',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.Coordinates')],
            ['name' => 'SourceCoords',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.SourceCoords')],
            ['name' => 'AdministrativeLocation',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.AdministrativeLocation')],
        ];

        parent::__construct($attributes);
    }
}
