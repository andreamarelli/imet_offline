<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class HRmanagementSystems extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_hr_management_systems';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR3';
        $this->module_title = trans('form/imet/v2/evaluation.HRmanagementSystems.title');
        $this->module_fields = [
            ['name' => 'Conditions',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.HRmanagementSystems.fields.Conditions')],
            ['name' => 'EvaluationScore',  'type' => 'blade-admin.imet.components.rating-0to3WithNA',   'label' => trans('form/imet/v2/evaluation.HRmanagementSystems.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.HRmanagementSystems.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Conditions',
            'values' => trans('form/imet/v2/evaluation.HRmanagementSystems.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.HRmanagementSystems.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.HRmanagementSystems.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.HRmanagementSystems.ratingLegend');

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null, $db_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            return null;  // fully incompatible
        }

        return $record;
    }
}