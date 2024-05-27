<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;


class EmpowermentGovernance extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_empowerment_governance';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR3';
        $this->module_title = trans('imet-core::oecm_evaluation.EmpowermentGovernance.title');
        $this->module_fields = [
            ['name' => 'Conditions',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.EmpowermentGovernance.fields.Conditions')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.EmpowermentGovernance.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.EmpowermentGovernance.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.EmpowermentGovernance.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.EmpowermentGovernance.groups.group1'),
            'group2' => trans('imet-core::oecm_evaluation.EmpowermentGovernance.groups.group2')
        ];

        $this->predefined_values = [
            'field' => 'Conditions',
            'values' => [
                'group0' => trans('imet-core::oecm_evaluation.EmpowermentGovernance.predefined_values.group0'),
                'group1' => trans('imet-core::oecm_evaluation.EmpowermentGovernance.predefined_values.group1'),
                'group2' => trans('imet-core::oecm_evaluation.EmpowermentGovernance.predefined_values.group2')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.EmpowermentGovernance.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.EmpowermentGovernance.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.EmpowermentGovernance.ratingLegend');

        parent::__construct($attributes);
    }


}
