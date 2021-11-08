<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class AnimalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_species_animal_presence';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.1';
        $this->module_title = trans('imet-core::v1_context.AnimalSpecies.title');
        $this->module_fields = [
            ['name' => 'species',                 'type' => 'selector-species_animal',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.SpeciesID')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'integer',            'label' => trans('imet-core::v1_context.AnimalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'integer',            'label' => trans('imet-core::v1_context.AnimalSpecies.fields.DesiredPopulation')],
            ['name' => 'TrendRating',               'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.TrendRating')],
            ['name' => 'Reliability',               'type' => 'dropdown-ImetV1_SpeciesReliability', 'label' => trans('imet-core::v1_context.AnimalSpecies.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Comments',                  'type' => 'text-area',           'label' => trans('imet-core::v1_context.AnimalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v1_context.AnimalSpecies.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.AnimalSpecies.ratingLegend');


        parent::__construct($attributes);

    }
}
