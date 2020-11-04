<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class GeographicalLocation extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_localization';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.1';
        $this->module_title = trans('form/imet/v1/context.GeographicalLocation.title');
        $this->module_fields = [
            ['name' => 'LimitsExist',  'type' => 'toggle-yes_no',   'label' => trans('form/imet/v1/context.GeographicalLocation.fields.LimitsExist')],
            ['name' => 'Shapefile',  'type' => 'upload',   'label' => trans('form/imet/v1/context.GeographicalLocation.fields.Shapefile')],
            ['name' => 'SourceSHP',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeographicalLocation.fields.SourceSHP')],
            ['name' => 'Coordinates',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeographicalLocation.fields.Coordinates')],
            ['name' => 'SourceCoords',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeographicalLocation.fields.SourceCoords')],
            ['name' => 'AdministrativeLocation',  'type' => 'text-area',   'label' => trans('form/imet/v1/context.GeographicalLocation.fields.AdministrativeLocation')],
        ];



        parent::__construct($attributes);

    }
}
