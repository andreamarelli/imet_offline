<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class VisitorsImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_visitors_impact';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR14';
        $this->module_title = trans('imet-core::v2_evaluation.VisitorsImpact.title');
        $this->module_fields = [
            ['name' => 'Impact',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.VisitorsImpact.fields.Impact')],
            ['name' => 'EvaluationScore',  'type' => 'blade-imet-core::components.rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.VisitorsImpact.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.VisitorsImpact.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Impact',
            'values' => trans('imet-core::v2_evaluation.VisitorsImpact.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.VisitorsImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.VisitorsImpact.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.VisitorsImpact.ratingLegend');

        parent::__construct($attributes);
    }


}
