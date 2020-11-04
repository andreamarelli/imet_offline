<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class AnimalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_species_animal_presence';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.1';
        $this->module_title = trans('form/imet/v1/context.AnimalSpecies.title');
        $this->module_fields = [
            ['name' => 'species',                 'type' => 'selector-species_animal',   'label' => trans('form/imet/v1/context.AnimalSpecies.fields.SpeciesID')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.AnimalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.AnimalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.AnimalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.AnimalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.AnimalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.AnimalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'integer',            'label' => trans('form/imet/v1/context.AnimalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'integer',            'label' => trans('form/imet/v1/context.AnimalSpecies.fields.DesiredPopulation')],
            ['name' => 'TrendRating',               'type' => 'rating-Minus2to2',   'label' => trans('form/imet/v1/context.AnimalSpecies.fields.TrendRating')],
            ['name' => 'Reliability',               'type' => 'dropdown-ImetV1_SpeciesReliability', 'label' => trans('form/imet/v1/context.AnimalSpecies.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Comments',                  'type' => 'text-area',           'label' => trans('form/imet/v1/context.AnimalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('form/imet/v1/context.AnimalSpecies.module_info');
        $this->ratingLegend = trans('form/imet/v1/context.AnimalSpecies.ratingLegend');


        parent::__construct($attributes);

    }
}