<?php

namespace App\Models\Imet\v2\Modules\Context;

use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class VegetalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_species_vegetal_presence';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.2';
        $this->module_title = trans('form/imet/v2/context.VegetalSpecies.title');
        $this->module_fields = [
            ['name' => 'Species',                   'type' => 'text-area',               'label' => trans('form/imet/v2/context.VegetalSpecies.fields.Species')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.VegetalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.VegetalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.VegetalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.VegetalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.VegetalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/context.VegetalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'numeric',            'label' => trans('form/imet/v2/context.VegetalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'numeric',            'label' => trans('form/imet/v2/context.VegetalSpecies.fields.DesiredPopulation')],
            ['name' => 'Comments',                  'type' => 'text-area',          'label' => trans('form/imet/v2/context.VegetalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('form/imet/v2/context.VegetalSpecies.module_info');


        parent::__construct($attributes);

    }

    public static function getVueData($form_id, $collection = null)
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('form/imet/v2/context.VegetalSpecies.warning_on_save');
        return $vue_data;
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
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
