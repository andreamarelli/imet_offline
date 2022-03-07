<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class AssistanceActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_assistance_activities';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR12';
        $this->module_title = trans('imet-core::v1_evaluation.AssistanceActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.AssistanceActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.AssistanceActivities.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.AssistanceActivities.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => trans('imet-core::v1_evaluation.AssistanceActivities.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.AssistanceActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.AssistanceActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.AssistanceActivities.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_AssistanceActivities',
            'fields' => [
                'Activity', 'EvaluationScore', 'Comments'
            ]
        ];
    }
}
