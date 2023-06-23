<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class NaturalResourcesMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_natural_resources_monitoring';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR7';
        $this->module_title = trans('imet-core::oecm_evaluation.NaturalResourcesMonitoring.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.NaturalResourcesMonitoring.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.NaturalResourcesMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.NaturalResourcesMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::oecm_evaluation.NaturalResourcesMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.NaturalResourcesMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.NaturalResourcesMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.NaturalResourcesMonitoring.ratingLegend');

        parent::__construct($attributes);
    }

}
