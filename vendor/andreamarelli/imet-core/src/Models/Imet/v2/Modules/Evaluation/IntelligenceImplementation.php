<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class IntelligenceImplementation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_intelligence_implementation';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR9';
        $this->module_title = trans('imet-core::v2_evaluation.IntelligenceImplementation.title');
        $this->module_fields = [
            ['name' => 'Element',   'type' => 'text-area',          'label' => trans('imet-core::v2_evaluation.IntelligenceImplementation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'Adequacy',  'type' => 'imet-core::rating-0to3WithNA',  'label' => trans('imet-core::v2_evaluation.IntelligenceImplementation.fields.Adequacy')],
            ['name' => 'Comments',  'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.IntelligenceImplementation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.IntelligenceImplementation.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.IntelligenceImplementation.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.IntelligenceImplementation.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.IntelligenceImplementation.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.IntelligenceImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.IntelligenceImplementation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.IntelligenceImplementation.ratingLegend');

        parent::__construct($attributes);

    }
}
