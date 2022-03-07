<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class AnimalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_species_animal_presence';

    protected $validation_min3 = '';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.1';
        $this->module_title = trans('imet-core::v2_context.AnimalSpecies.title');
        $this->module_fields = [
            ['name' => 'species',                   'type' => 'selector-species_animal_withFreeText',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.SpeciesID')],
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

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('imet-core::v2_context.AnimalSpecies.warning_on_save');
        return $vue_data;
    }

    public static function updateModule(Request $request): array
    {
        static::forceLanguage($request->input('form_id'));

        $records = json_decode($request->input('records_json'), true);
        $form_id = $request->input('form_id');

        static::dropFromDependencies($form_id, $records, [
            Modules\Evaluation\ImportanceSpecies::class,
            Modules\Evaluation\InformationAvailability::class,
            Modules\Evaluation\KeyConservationTrend::class,
            Modules\Evaluation\ManagementActivities::class,
        ]);

        return parent::updateModule($request);
    }

}
