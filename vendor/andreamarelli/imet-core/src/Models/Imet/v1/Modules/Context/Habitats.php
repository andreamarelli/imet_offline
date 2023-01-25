<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_habitats';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.3.1';
        $this->module_title = trans('imet-core::v1_context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType',             'type' => 'text-area',   'label' => trans('imet-core::v1_context.Habitats.fields.EcosystemType')],
            ['name' => 'Value',                     'type' => 'text-area',   'label' => trans('imet-core::v1_context.Habitats.fields.Value')],
            ['name' => 'Area',                      'type' => 'integer',   'label' => trans('imet-core::v1_context.Habitats.fields.Area')],
            ['name' => 'DesiredConservationStatus', 'type' => 'integer',   'label' => trans('imet-core::v1_context.Habitats.fields.DesiredConservationStatus')],
            ['name' => 'Trend',                     'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v1_context.Habitats.fields.Trend')],
            ['name' => 'Reliability',               'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('imet-core::v1_context.Habitats.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Sectors',                   'type' => 'text-area',   'label' => trans('imet-core::v1_context.Habitats.fields.Sectors')],
        ];


        $this->module_info = trans('imet-core::v1_context.Habitats.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.Habitats.ratingLegend');

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
            'table' => 'Habitats',
            'fields' => [
                'EcosystemType',
                'Value',
                'Area',
                'DesiredConservationStatus',
                'Trend',
                'Reliability',
                'Sectors'
            ]
        ];
    }
}
