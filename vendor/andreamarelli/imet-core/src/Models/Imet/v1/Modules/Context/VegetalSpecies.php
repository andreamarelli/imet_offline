<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class VegetalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_species_vegetal_presence';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.2';
        $this->module_title = trans('imet-core::v1_context.VegetalSpecies.title');
        $this->module_fields = [
            ['name' => 'Species',                   'type' => 'text-area',               'label' => trans('imet-core::v1_context.VegetalSpecies.fields.Species')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.VegetalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.VegetalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.VegetalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.VegetalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.VegetalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.VegetalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'integer',            'label' => trans('imet-core::v1_context.VegetalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'integer',            'label' => trans('imet-core::v1_context.VegetalSpecies.fields.DesiredPopulation')],
            ['name' => 'TrendRating',               'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v1_context.VegetalSpecies.fields.TrendRating')],
            ['name' => 'Reliability',               'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('imet-core::v1_context.VegetalSpecies.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Comments',                  'type' => 'text-area',          'label' => trans('imet-core::v1_context.VegetalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v1_context.VegetalSpecies.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.VegetalSpecies.ratingLegend');

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
            'table' => 'SpeciesVegetalPresence',
            'fields' => [
                'Species',
                "FlagshipSpecies",
                "EndangeredSpecies",
                "EndemicSpecies",
                "ExploitedSpecies",
                "InvasiveSpecies",
                "InsufficientDataSpecies",
                'PopulationEstimation',
                'DesiredPopulation',
                'TrendRating',
                'Reliability',
                'Comments'
            ]
        ];
    }
}
