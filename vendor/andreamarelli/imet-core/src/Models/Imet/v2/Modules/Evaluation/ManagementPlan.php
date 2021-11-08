<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class ManagementPlan extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_management_plan';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'P4';
        $this->module_title = trans('imet-core::v2_evaluation.ManagementPlan.title');
        $this->module_fields = [
            ['name' => 'PlanExistence',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::v2_evaluation.ManagementPlan.fields.PlanExistence')],
            ['name' => 'PlanUptoDate',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::v2_evaluation.ManagementPlan.fields.PlanUptoDate')],
            ['name' => 'PlanApproved',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::v2_evaluation.ManagementPlan.fields.PlanApproved')],
            ['name' => 'PlanImplemented',     'type' => 'toggle-yes_no',    'label' => trans('imet-core::v2_evaluation.ManagementPlan.fields.PlanImplemented')],
            ['name' => 'VisionAdequacy',     'type' => 'imet-core::rating-0to3',    'label' => trans('imet-core::v2_evaluation.ManagementPlan.fields.VisionAdequacy')],
            ['name' => 'PlanAdequacyScore',     'type' => 'imet-core::rating-0to3',    'label' => trans('imet-core::v2_evaluation.ManagementPlan.fields.PlanAdequacyScore')],
            ['name' => 'Comments',              'type' => 'text-area',           'label' => trans('imet-core::v2_evaluation.ManagementPlan.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ManagementPlan.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ManagementPlan.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ManagementPlan.ratingLegend');

        parent::__construct($attributes);
    }

    private static function ensureNullValues($data)
    {
        if($data['PlanExistence'] === false || $data['PlanExistence'] === "false"){
            $data['PlanUptoDate'] = false;
            $data['PlanApproved'] = false;
            $data['PlanImplemented'] = false;
            $data['VisionAdequacy'] = 0;
            $data['PlanAdequacyScore'] = 0;
        }
        return $data;
    }

    public static function updateModule(Request $request): array
    {
        $records = json_decode($request->input('records_json'), true);
        $records[0] = static::ensureNullValues($records[0]);
        $request->merge(['records_json' => json_encode($records)]);
        return parent::updateModule($request);
    }

    public static function importModule($form_id, $data)
    {
        $data = static::ensureNullValues($data);
        parent::importModule($form_id, $data);
    }



}
