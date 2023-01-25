<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class AreaDominationMPA extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_area_domination_mpa';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public const MODULE_SCOPE = self::MARINE;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'O/P4';
        $this->module_title = trans('imet-core::v2_evaluation.AreaDominationMPA.title');
        $this->module_fields = [
            ['name' => 'Activity',                      'type' => 'text-area',              'label' => trans('imet-core::v2_evaluation.AreaDominationMPA.fields.Activity')],
            ['name' => 'Patrol',                        'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::v2_evaluation.AreaDominationMPA.fields.Patrol')],
            ['name' => 'RapidIntervention',             'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::v2_evaluation.AreaDominationMPA.fields.RapidIntervention')],
            ['name' => 'DetectionRemoteSensing',        'type' => 'toggle-yes_no',          'label' => trans('imet-core::v2_evaluation.AreaDominationMPA.fields.DetectionRemoteSensing')],
            ['name' => 'SpecialMeansRapidIntervention', 'type' => 'toggle-yes_no',          'label' => trans('imet-core::v2_evaluation.AreaDominationMPA.fields.SpecialMeansRapidIntervention')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.AreaDominationMPA.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.AreaDominationMPA.groups.group1'),
            'group2' => trans('imet-core::v2_evaluation.AreaDominationMPA.groups.group2'),
            'group3' => trans('imet-core::v2_evaluation.AreaDominationMPA.groups.group3'),
            'group4' => trans('imet-core::v2_evaluation.AreaDominationMPA.groups.group4'),
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.AreaDominationMPA.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.AreaDominationMPA.predefined_values.group1'),
                'group2' => trans('imet-core::v2_evaluation.AreaDominationMPA.predefined_values.group2'),
                'group3' => trans('imet-core::v2_evaluation.AreaDominationMPA.predefined_values.group3'),
                'group4' => trans('imet-core::v2_evaluation.AreaDominationMPA.predefined_values.group4')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AreaDominationMPA.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AreaDominationMPA.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AreaDominationMPA.ratingLegend');

        parent::__construct($attributes);
    }
}
