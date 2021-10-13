<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class ResearchAndMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_research_and_monitoring';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR16';
        $this->module_title = trans('imet-core::v2_evaluation.ResearchAndMonitoring.title');
        $this->module_fields = [
            ['name' => 'Program',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ResearchAndMonitoring.fields.Program')],
            ['name' => 'EvaluationScore',  'type' => 'blade-imet-core::components.rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ResearchAndMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ResearchAndMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Program',
            'values' => trans('imet-core::v2_evaluation.ResearchAndMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ResearchAndMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ResearchAndMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ResearchAndMonitoring.ratingLegend');

        parent::__construct($attributes);
    }


}
