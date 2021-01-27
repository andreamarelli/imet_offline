<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class WorkPlan extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_work_plan';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'P5';
        $this->module_title = trans('form/imet/v2/evaluation.WorkPlan.title');
        $this->module_fields = [
            ['name' => 'PlanExistence',     'type' => 'toggle-yes_no',    'label' => trans('form/imet/v2/evaluation.WorkPlan.fields.PlanExistence')],
            ['name' => 'PlanUptoDate',     'type' => 'toggle-yes_no',    'label' => trans('form/imet/v2/evaluation.WorkPlan.fields.PlanUptoDate')],
            ['name' => 'PlanApproved',     'type' => 'toggle-yes_no',    'label' => trans('form/imet/v2/evaluation.WorkPlan.fields.PlanApproved')],
            ['name' => 'PlanImplemented',     'type' => 'toggle-yes_no',    'label' => trans('form/imet/v2/evaluation.WorkPlan.fields.PlanImplemented')],
            ['name' => 'VisionAdequacy',     'type' => 'blade-admin.imet.components.rating-0to3',    'label' => trans('form/imet/v2/evaluation.WorkPlan.fields.VisionAdequacy')],
            ['name' => 'PlanAdequacyScore',     'type' => 'blade-admin.imet.components.rating-0to3',    'label' => trans('form/imet/v2/evaluation.WorkPlan.fields.PlanAdequacyScore')],
            ['name' => 'Comments',              'type' => 'text-area',           'label' => trans('form/imet/v2/evaluation.WorkPlan.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.WorkPlan.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.WorkPlan.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.WorkPlan.ratingLegend');

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
