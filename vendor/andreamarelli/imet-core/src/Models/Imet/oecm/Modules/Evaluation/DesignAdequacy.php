<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class DesignAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_design_adequacy';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P2';
        $this->module_title = trans('imet-core::oecm_evaluation.DesignAdequacy.title');
        $this->module_fields = [
            ['name' => 'Values',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.DesignAdequacy.fields.Values')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.DesignAdequacy.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.DesignAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Values',
            'values' => trans('imet-core::oecm_evaluation.DesignAdequacy.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.DesignAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.DesignAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.DesignAdequacy.ratingLegend');

        parent::__construct($attributes);
    }

}
