<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class AssistanceActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_assistance_activities';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR11';
        $this->module_title = trans('form/imet/v2/evaluation.AssistanceActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.AssistanceActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'blade-admin.imet.components.rating-0to3WithNA',   'label' => trans('form/imet/v2/evaluation.AssistanceActivities.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.AssistanceActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v2/evaluation.AssistanceActivities.groups.group0'),
            'group1' => trans('form/imet/v2/evaluation.AssistanceActivities.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => [
                'group0' => trans('form/imet/v2/evaluation.AssistanceActivities.predefined_values.group0'),
                'group1' => trans('form/imet/v2/evaluation.AssistanceActivities.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.AssistanceActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.AssistanceActivities.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.AssistanceActivities.ratingLegend');

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            return null;  // fully incompatible
        }

        return $record;
    }
}
