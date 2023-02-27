<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class RegulationsAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_regulations_adequacy';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P1';
        $this->module_title = trans('imet-core::oecm_evaluation.RegulationsAdequacy.title');
        $this->module_fields = [
            ['name' => 'Regulation',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.RegulationsAdequacy.fields.Regulation')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.RegulationsAdequacy.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.RegulationsAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Regulation',
            'values' => trans('imet-core::oecm_evaluation.RegulationsAdequacy.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.RegulationsAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.RegulationsAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.RegulationsAdequacy.ratingLegend');

        parent::__construct($attributes);
    }

}
