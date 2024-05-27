<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class WorkPlan extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_work_plan';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'P5';
        $this->module_title = trans('imet-core::oecm_evaluation.WorkPlan.title');
        $this->module_fields = [
            ['name' => 'PlanExistence',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanExistence')],
            ['name' => 'PrintedCopy',           'type' => 'toggle-yes_no',          'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PrintedCopy')],
            ['name' => 'KnowledgePercentage',   'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.KnowledgePercentage')],
            ['name' => 'PlanUptoDate',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanUptoDate')],
            ['name' => 'PlanApproved',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanApproved')],
            ['name' => 'PlanImplemented',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanImplemented')],
            ['name' => 'PlanAdequacyScore',     'type' => 'imet-core::rating-0to3',    'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.PlanAdequacyScore')],
            ['name' => 'Comments',              'type' => 'text-area',           'label' => trans('imet-core::oecm_evaluation.WorkPlan.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.WorkPlan.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.WorkPlan.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.WorkPlan.ratingLegend');

        parent::__construct($attributes);
    }

    private static function ensureNullValues($data)
    {
        if($data['PlanExistence'] === false || $data['PlanExistence'] === "false"){
            $data['PlanUptoDate'] = false;
            $data['PlanApproved'] = false;
            $data['PlanImplemented'] = false;
            $data['PlanAdequacyScore'] = 0;
        }
        return $data;
    }

    public static function updateModule(Request $request): array
    {
        $records = Payload::decode($request->input('records_json'));
        $records[0] = static::ensureNullValues($records[0]);
        $request->merge(['records_json' => Payload::encode($records)]);
        return parent::updateModule($request);
    }

    public static function importModule($form_id, $data)
    {
        $data = static::ensureNullValues($data);
        parent::importModule($form_id, $data);
    }


}
