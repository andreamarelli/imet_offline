<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class VisitorsManagement extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_visitors_management';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR12';
        $this->module_title = trans('imet-core::oecm_evaluation.VisitorsManagement.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.VisitorsManagement.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.VisitorsManagement.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.VisitorsManagement.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::oecm_evaluation.VisitorsManagement.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.VisitorsManagement.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.VisitorsManagement.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.VisitorsManagement.ratingLegend');

        parent::__construct($attributes);
    }


}
