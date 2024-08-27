<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class SupportsAndConstraints extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_supports_and_constaints';
//    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C2';
        $this->module_title = trans('imet-core::v2_evaluation.SupportsAndConstraints.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.SupportsAndConstraints.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-1to3WithNA',   'label' => trans('imet-core::v2_evaluation.SupportsAndConstraints.fields.EvaluationScore')],
            ['name' => 'EvaluationScore2',  'type' => 'rating-Minus3to3',   'label' => trans('imet-core::v2_evaluation.SupportsAndConstraints.fields.EvaluationScore2')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.SupportsAndConstraints.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.SupportsAndConstraints.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.SupportsAndConstraints.groups.group1'),
            'group2' => trans('imet-core::v2_evaluation.SupportsAndConstraints.groups.group2'),
            'group3' => trans('imet-core::v2_evaluation.SupportsAndConstraints.groups.group3'),
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.SupportsAndConstraints.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.SupportsAndConstraints.predefined_values.group1'),
                'group2' => trans('imet-core::v2_evaluation.SupportsAndConstraints.predefined_values.group2'),
                'group3' => trans('imet-core::v2_evaluation.SupportsAndConstraints.predefined_values.group3')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.SupportsAndConstraints.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.SupportsAndConstraints.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.SupportsAndConstraints.ratingLegend');

        parent::__construct($attributes);
    }


}
