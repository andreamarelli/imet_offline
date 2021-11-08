<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class LawEnforcementImplementation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_law_enforcement_implementation';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR8';
        $this->module_title = trans('imet-core::v2_evaluation.LawEnforcementImplementation.title');
        $this->module_fields = [
            ['name' => 'Element',   'type' => 'text-area',          'label' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'Adequacy',  'type' => 'imet-core::rating-0to3WithNA',  'label' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.fields.Adequacy')],
            ['name' => 'Comments',  'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.LawEnforcementImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.LawEnforcementImplementation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.LawEnforcementImplementation.ratingLegend');

        parent::__construct($attributes);

    }
}
