<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Threats extends Modules\Component\ImetModule_Eval {

    protected $table = 'imet_oecm.eval_threats';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3';
        $this->module_title = trans('imet-core::oecm_evaluation.Threats.title');
        $this->module_fields = [
            ['name' => 'Value',         'type' => 'text-area',                      'label' => trans('imet-core::oecm_evaluation.Threats.fields.Value')],
            ['name' => 'Impact',        'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Impact')],
            ['name' => 'Extension',     'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Extension')],
            ['name' => 'Duration',      'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Duration')],
            ['name' => 'Trend',         'type' => 'imet-core::rating-Minus2to2',   'label' => trans('imet-core::oecm_evaluation.Threats.fields.Trend')],
            ['name' => 'Probability',   'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Probability')],
        ];

        $this->predefined_values = [
            'field' => 'Value',
            'values' => trans('imet-core::oecm_evaluation.Threats.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Threats.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.Threats.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Threats.ratingLegend');

        parent::__construct($attributes);
    }

}