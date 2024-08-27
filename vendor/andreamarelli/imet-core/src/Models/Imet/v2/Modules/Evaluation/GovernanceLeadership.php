<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class GovernanceLeadership extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_governance_leadership';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'PR4';
        $this->module_title = trans('imet-core::v2_evaluation.GovernanceLeadership.title');
        $this->module_fields = [
            ['name' => 'EvaluationScoreGovernace',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.GovernanceLeadership.fields.EvaluationScoreGovernace')],
            ['name' => 'EvaluationScoreLeadership',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.GovernanceLeadership.fields.EvaluationScoreLeadership')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.GovernanceLeadership.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.GovernanceLeadership.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.GovernanceLeadership.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.GovernanceLeadership.ratingLegend');

        parent::__construct($attributes);
    }


}
