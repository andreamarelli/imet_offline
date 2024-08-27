<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class AdministrativeManagement extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_administrative_management';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR5';
        $this->module_title = trans('imet-core::v2_evaluation.AdministrativeManagement.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AdministrativeManagement.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to4WithNA',   'label' => trans('imet-core::v2_evaluation.AdministrativeManagement.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AdministrativeManagement.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::v2_evaluation.AdministrativeManagement.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AdministrativeManagement.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AdministrativeManagement.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AdministrativeManagement.ratingLegend');

        parent::__construct($attributes);
    }


}
