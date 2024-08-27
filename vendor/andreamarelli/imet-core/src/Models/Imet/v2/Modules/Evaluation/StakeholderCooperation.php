<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class StakeholderCooperation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_stakeholder_cooperation';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR10';
        $this->module_title = trans('imet-core::v2_evaluation.StakeholderCooperation.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'text-area',          'label' => trans('imet-core::v2_evaluation.StakeholderCooperation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'MPInvolvement',     'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::v2_evaluation.StakeholderCooperation.fields.MPInvolvement')],
            ['name' => 'MPIImplementation', 'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::v2_evaluation.StakeholderCooperation.fields.MPIImplementation')],
            ['name' => 'BAInvolvement',     'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::v2_evaluation.StakeholderCooperation.fields.BAInvolvement')],
            ['name' => 'EEInvolvement',     'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::v2_evaluation.StakeholderCooperation.fields.EEInvolvement')],
            ['name' => 'Cooperation',       'type' => 'rating-0to3WithNA',  'label' => trans('imet-core::v2_evaluation.StakeholderCooperation.fields.Cooperation')],
            ['name' => 'Comments',          'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.StakeholderCooperation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.StakeholderCooperation.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.StakeholderCooperation.groups.group1'),
            'group2' => trans('imet-core::v2_evaluation.StakeholderCooperation.groups.group2'),
            'group3' => trans('imet-core::v2_evaluation.StakeholderCooperation.groups.group3'),
            'group4' => trans('imet-core::v2_evaluation.StakeholderCooperation.groups.group4'),
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.StakeholderCooperation.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.StakeholderCooperation.predefined_values.group1'),
                'group2' => trans('imet-core::v2_evaluation.StakeholderCooperation.predefined_values.group2'),
                'group3' => trans('imet-core::v2_evaluation.StakeholderCooperation.predefined_values.group3'),
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.StakeholderCooperation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.StakeholderCooperation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.StakeholderCooperation.ratingLegend');

        parent::__construct($attributes);

    }
}
