<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_habitats';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.3.1';
        $this->module_title = trans('form/imet/v1/context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType',             'type' => 'text-area',   'label' => trans('form/imet/v1/context.Habitats.fields.EcosystemType')],
            ['name' => 'Value',                     'type' => 'text-area',   'label' => trans('form/imet/v1/context.Habitats.fields.Value')],
            ['name' => 'Area',                      'type' => 'integer',   'label' => trans('form/imet/v1/context.Habitats.fields.Area')],
            ['name' => 'DesiredConservationStatus', 'type' => 'integer',   'label' => trans('form/imet/v1/context.Habitats.fields.DesiredConservationStatus')],
            ['name' => 'Trend',                     'type' => 'rating-Minus2to2',   'label' => trans('form/imet/v1/context.Habitats.fields.Trend')],
            ['name' => 'Reliability',               'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('form/imet/v1/context.Habitats.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Sectors',                   'type' => 'text-area',   'label' => trans('form/imet/v1/context.Habitats.fields.Sectors')],
        ];


        $this->module_info = trans('form/imet/v1/context.Habitats.module_info');
        $this->ratingLegend = trans('form/imet/v1/context.Habitats.ratingLegend');

        parent::__construct($attributes);

    }
}