<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class StakeholderCooperation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_stakeholder_cooperation';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR10';
        $this->module_title = trans('form/imet/v2/evaluation.StakeholderCooperation.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'text-area',          'label' => trans('form/imet/v2/evaluation.StakeholderCooperation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'MPInvolvement',     'type' => 'checkbox-boolean_numeric',  'label' => trans('form/imet/v2/evaluation.StakeholderCooperation.fields.MPInvolvement')],
            ['name' => 'MPIImplementation', 'type' => 'checkbox-boolean_numeric',  'label' => trans('form/imet/v2/evaluation.StakeholderCooperation.fields.MPIImplementation')],
            ['name' => 'BAInvolvement',     'type' => 'checkbox-boolean_numeric',  'label' => trans('form/imet/v2/evaluation.StakeholderCooperation.fields.BAInvolvement')],
            ['name' => 'EEInvolvement',     'type' => 'checkbox-boolean_numeric',  'label' => trans('form/imet/v2/evaluation.StakeholderCooperation.fields.EEInvolvement')],
            ['name' => 'Cooperation',       'type' => 'blade-admin.imet.components.rating-0to3WithNA',  'label' => trans('form/imet/v2/evaluation.StakeholderCooperation.fields.Cooperation')],
            ['name' => 'Comments',          'type' => 'text-area',               'label' => trans('form/imet/v2/evaluation.StakeholderCooperation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v2/evaluation.StakeholderCooperation.groups.group0'),
            'group1' => trans('form/imet/v2/evaluation.StakeholderCooperation.groups.group1'),
            'group2' => trans('form/imet/v2/evaluation.StakeholderCooperation.groups.group2'),
            'group3' => trans('form/imet/v2/evaluation.StakeholderCooperation.groups.group3'),
            'group4' => trans('form/imet/v2/evaluation.StakeholderCooperation.groups.group4'),
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('form/imet/v2/evaluation.StakeholderCooperation.predefined_values.group0'),
                'group1' => trans('form/imet/v2/evaluation.StakeholderCooperation.predefined_values.group1'),
                'group2' => trans('form/imet/v2/evaluation.StakeholderCooperation.predefined_values.group2'),
                'group3' => trans('form/imet/v2/evaluation.StakeholderCooperation.predefined_values.group3'),
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.StakeholderCooperation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.StakeholderCooperation.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.StakeholderCooperation.ratingLegend');

        parent::__construct($attributes);

    }
}