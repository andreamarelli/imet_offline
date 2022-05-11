<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class AreaDomination extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_area_domination';

    public const MODULE_SCOPE = self::TERRESTRIAL_AND_MARINE;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'O/P3';
        $this->module_title = trans('imet-core::v2_evaluation.AreaDomination.title');
        $this->module_fields = [
            ['name' => 'Patrol',            'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.Patrol')],
            ['name' => 'RapidIntervention', 'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.RapidIntervention')],
            ['name' => 'AirVehicles',       'type' => 'toggle-yes_no',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.AirVehicles')],
            ['name' => 'Planes',            'type' => 'toggle-yes_no',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.Planes')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AreaDomination.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AreaDomination.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AreaDomination.ratingLegend');

        parent::__construct($attributes);

    }
}
