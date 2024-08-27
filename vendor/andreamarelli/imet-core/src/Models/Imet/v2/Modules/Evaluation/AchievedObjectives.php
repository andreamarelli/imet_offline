<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class AchievedObjectives extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_achived_objectives';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'O/C1';
        $this->module_title = trans('imet-core::v2_evaluation.AchievedObjectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AchievedObjectives.fields.Objective')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.AchievedObjectives.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AchievedObjectives.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AchievedObjectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AchievedObjectives.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AchievedObjectives.ratingLegend');

        parent::__construct($attributes);
    }

}
