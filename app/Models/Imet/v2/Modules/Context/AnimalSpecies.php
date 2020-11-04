<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\v2\Imet;
use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class AnimalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_species_animal_presence';

    protected $validation_min3 = '';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.1';
        $this->module_title = trans('form/imet/v2/context.AnimalSpecies.title');
        $this->module_fields = [
            ['name' => 'species',                   'type' => 'selector-species_animal_withFreeText',   'label' => trans('form/imet/v2/context.AnimalSpecies.fields.SpeciesID')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.AnimalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.AnimalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.AnimalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.AnimalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.AnimalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.AnimalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'numeric',            'label' => trans('form/imet/v2/context.AnimalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'numeric',            'label' => trans('form/imet/v2/context.AnimalSpecies.fields.DesiredPopulation')],
            ['name' => 'Comments',                  'type' => 'text-area',           'label' => trans('form/imet/v2/context.AnimalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('form/imet/v2/context.AnimalSpecies.module_info');

        $this->validation_min3 = trans('form/imet/v2/context.AnimalSpecies.validation_min3');

        parent::__construct($attributes);

    }

    public static function getVueData($form_id, $collection = null)
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('form/imet/v2/context.AnimalSpecies.warning_on_save');
        return $vue_data;
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::dropField($record, 'TrendRating');
            $record = static::dropField($record, 'Reliability');
        }

        return $record;
    }

    public static function updateModule(Request $request)
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