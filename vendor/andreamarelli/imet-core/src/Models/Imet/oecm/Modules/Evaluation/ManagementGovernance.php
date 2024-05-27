<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ManagementGovernance extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_management_governance';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'O/P2';
        $this->module_title = trans('imet-core::oecm_evaluation.ManagementGovernance.title');
        $this->module_fields = [
            ['name' => 'Patrol',            'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.ManagementGovernance.fields.Patrol')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.ManagementGovernance.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.ManagementGovernance.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.ManagementGovernance.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ManagementGovernance.ratingLegend');

        parent::__construct($attributes);

    }
}
