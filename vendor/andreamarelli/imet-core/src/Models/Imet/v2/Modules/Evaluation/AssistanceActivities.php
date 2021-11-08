<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class AssistanceActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_assistance_activities';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR11';
        $this->module_title = trans('imet-core::v2_evaluation.AssistanceActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AssistanceActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.AssistanceActivities.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AssistanceActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.AssistanceActivities.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.AssistanceActivities.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.AssistanceActivities.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.AssistanceActivities.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AssistanceActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AssistanceActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AssistanceActivities.ratingLegend');

        parent::__construct($attributes);
    }


}
