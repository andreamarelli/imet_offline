<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class AnimalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'context_species_animal_presence';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\ImportanceSpecies::class, 'species'],
        [Modules\Evaluation\InformationAvailability::class, 'species'],
        [Modules\Evaluation\KeyConservationTrend::class, 'species'],
        [Modules\Evaluation\ManagementActivities::class, 'species'],
    ];

    protected $validation_min3 = '';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.1';
        $this->module_title = trans('imet-core::v2_context.AnimalSpecies.title');
        $this->module_fields = [
            ['name' => 'species',                   'type' => 'selector-species_animal-withInsert',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.SpeciesID')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'numeric',            'label' => trans('imet-core::v2_context.AnimalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'numeric',            'label' => trans('imet-core::v2_context.AnimalSpecies.fields.DesiredPopulation')],
            ['name' => 'Comments',                  'type' => 'text-area',           'label' => trans('imet-core::v2_context.AnimalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v2_context.AnimalSpecies.module_info');

        $this->validation_min3 = trans('imet-core::v2_context.AnimalSpecies.validation_min3');

        parent::__construct($attributes);
    }

}
