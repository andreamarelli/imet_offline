<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class VisitorsManagement extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_visitors_management';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR13';
        $this->module_title = trans('imet-core::v2_evaluation.VisitorsManagement.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.VisitorsManagement.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'blade-imet-core::components.rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.VisitorsManagement.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.VisitorsManagement.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::v2_evaluation.VisitorsManagement.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.VisitorsManagement.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.VisitorsManagement.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.VisitorsManagement.ratingLegend');

        parent::__construct($attributes);
    }


}
