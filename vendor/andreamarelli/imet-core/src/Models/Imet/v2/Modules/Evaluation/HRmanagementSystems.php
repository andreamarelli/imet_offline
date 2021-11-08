<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class HRmanagementSystems extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_hr_management_systems';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR3';
        $this->module_title = trans('imet-core::v2_evaluation.HRmanagementSystems.title');
        $this->module_fields = [
            ['name' => 'Conditions',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.HRmanagementSystems.fields.Conditions')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.HRmanagementSystems.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.HRmanagementSystems.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Conditions',
            'values' => trans('imet-core::v2_evaluation.HRmanagementSystems.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.HRmanagementSystems.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.HRmanagementSystems.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.HRmanagementSystems.ratingLegend');

        parent::__construct($attributes);
    }


}
