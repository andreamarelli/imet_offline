<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class AssistanceActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_assistance_activities';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR9';
        $this->module_title = trans('imet-core::oecm_evaluation.AssistanceActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.AssistanceActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.AssistanceActivities.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.AssistanceActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.AssistanceActivities.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.AssistanceActivities.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => [
                'group0' => trans('imet-core::oecm_evaluation.AssistanceActivities.predefined_values.group0'),
                'group1' => trans('imet-core::oecm_evaluation.AssistanceActivities.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.AssistanceActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.AssistanceActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.AssistanceActivities.ratingLegend');

        parent::__construct($attributes);
    }

    public static function get_terrestrial_predefined(): array
    {
        $predefined = (new static())->predefined_values['values'];
        return [
            $predefined['group0'][17]
        ];
    }

    public static function get_marine_predefined(): array
    {
        $predefined = (new static())->predefined_values['values'];
        return [
            $predefined['group0'][18],
            $predefined['group0'][19],
            $predefined['group0'][20]
        ];
    }

}
