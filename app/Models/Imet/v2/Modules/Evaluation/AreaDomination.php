<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class AreaDomination extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_area_domination';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'O/P3';
        $this->module_title = trans('form/imet/v2/evaluation.AreaDomination.title');
        $this->module_fields = [
            ['name' => 'Patrol',            'type' => 'blade-admin.imet.components.rating-0to3',   'label' => trans('form/imet/v2/evaluation.AreaDomination.fields.Patrol')],
            ['name' => 'RapidIntervention', 'type' => 'blade-admin.imet.components.rating-0to3',   'label' => trans('form/imet/v2/evaluation.AreaDomination.fields.RapidIntervention')],
            ['name' => 'AirVehicles',       'type' => 'toggle-yes_no',   'label' => trans('form/imet/v2/evaluation.AreaDomination.fields.AirVehicles')],
            ['name' => 'Planes',            'type' => 'toggle-yes_no',   'label' => trans('form/imet/v2/evaluation.AreaDomination.fields.Planes')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.AreaDomination.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.AreaDomination.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.AreaDomination.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.AreaDomination.ratingLegend');

        parent::__construct($attributes);

    }
}