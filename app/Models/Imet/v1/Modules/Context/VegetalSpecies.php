<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class VegetalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_species_vegetal_presence';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.2';
        $this->module_title = trans('form/imet/v1/context.VegetalSpecies.title');
        $this->module_fields = [
            ['name' => 'Species',                   'type' => 'text-area',               'label' => trans('form/imet/v1/context.VegetalSpecies.fields.Species')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.VegetalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.VegetalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.VegetalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.VegetalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.VegetalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('form/imet/v1/context.VegetalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'integer',            'label' => trans('form/imet/v1/context.VegetalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'integer',            'label' => trans('form/imet/v1/context.VegetalSpecies.fields.DesiredPopulation')],
            ['name' => 'TrendRating',               'type' => 'rating-Minus2to2',   'label' => trans('form/imet/v1/context.VegetalSpecies.fields.TrendRating')],
            ['name' => 'Reliability',               'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('form/imet/v1/context.VegetalSpecies.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Comments',                  'type' => 'text-area',          'label' => trans('form/imet/v1/context.VegetalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('form/imet/v1/context.VegetalSpecies.module_info');
        $this->ratingLegend = trans('form/imet/v1/context.VegetalSpecies.ratingLegend');


        parent::__construct($attributes);

    }
}