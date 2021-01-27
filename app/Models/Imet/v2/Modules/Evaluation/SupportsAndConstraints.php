<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class SupportsAndConstraints extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_supports_and_constaints';
//    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C2';
        $this->module_title = trans('form/imet/v2/evaluation.SupportsAndConstraints.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.SupportsAndConstraints.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'blade-admin.imet.components.rating-1to3WithNA',   'label' => trans('form/imet/v2/evaluation.SupportsAndConstraints.fields.EvaluationScore')],
            ['name' => 'EvaluationScore2',  'type' => 'blade-admin.imet.components.rating-Minus3to3',   'label' => trans('form/imet/v2/evaluation.SupportsAndConstraints.fields.EvaluationScore2')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.SupportsAndConstraints.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('form/imet/v2/evaluation.SupportsAndConstraints.predefined_values')
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v2/evaluation.SupportsAndConstraints.groups.group0'),
            'group1' => trans('form/imet/v2/evaluation.SupportsAndConstraints.groups.group1'),
            'group2' => trans('form/imet/v2/evaluation.SupportsAndConstraints.groups.group2'),
            'group3' => trans('form/imet/v2/evaluation.SupportsAndConstraints.groups.group3'),
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => [
                'group0' => trans('form/imet/v2/evaluation.SupportsAndConstraints.predefined_values.group0'),
                'group1' => trans('form/imet/v2/evaluation.SupportsAndConstraints.predefined_values.group1'),
                'group2' => trans('form/imet/v2/evaluation.SupportsAndConstraints.predefined_values.group2'),
                'group3' => trans('form/imet/v2/evaluation.SupportsAndConstraints.predefined_values.group3')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.SupportsAndConstraints.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.SupportsAndConstraints.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.SupportsAndConstraints.ratingLegend');

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
