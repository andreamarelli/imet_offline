<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class AchievedObjectives extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_achived_objectives';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'O/C1';
        $this->module_title = trans('imet-core::v2_evaluation.AchievedObjectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AchievedObjectives.fields.Objective')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_evaluation.AchievedObjectives.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AchievedObjectives.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AchievedObjectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AchievedObjectives.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AchievedObjectives.ratingLegend');

        parent::__construct($attributes);
    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record = static::dropField($record, 'Percentage');
//        return $record;
//    }

}
