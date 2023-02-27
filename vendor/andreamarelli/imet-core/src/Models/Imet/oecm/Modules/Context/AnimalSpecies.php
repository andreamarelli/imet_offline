<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class AnimalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_species_animal_presence';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected $validation_min3 = '';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.1';
        $this->module_title = trans('imet-core::oecm_context.AnimalSpecies.title');
        $this->module_fields = [
            ['name' => 'species', 'type' => 'imet-core::selector-species_animal_withFreeText', 'label' => trans('imet-core::oecm_context.AnimalSpecies.fields.SpeciesID')],
            ['name' => 'ExploitedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnimalSpecies.fields.ExploitedSpecies')],
            ['name' => 'ProtectedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnimalSpecies.fields.ProtectedSpecies')],
            ['name' => 'DisappearingSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnimalSpecies.fields.DisappearingSpecies')],
            ['name' => 'InvasiveSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnimalSpecies.fields.InvasiveSpecies')],
            ['name' => 'PopulationEstimation', 'type' => 'dropdown-ImetOECM_PopulationStatus', 'label' => trans('imet-core::oecm_context.AnimalSpecies.fields.PopulationEstimation')],
            ['name' => 'DescribeEstimation', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnimalSpecies.fields.DescribeEstimation')],
            ['name' => 'Comments', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnimalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::oecm_context.AnimalSpecies.module_info');

        $this->validation_min3 = trans('imet-core::oecm_context.AnimalSpecies.validation_min3');

        parent::__construct($attributes);

    }

}
