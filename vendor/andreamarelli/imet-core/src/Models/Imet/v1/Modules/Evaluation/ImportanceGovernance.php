<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ImportanceGovernance extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_importance_c11';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.1';
        $this->module_title = trans('imet-core::v1_evaluation.ImportanceGovernance.title');
        $this->module_fields = [
            ['name' => 'Aspect',            'type' => 'text-area',              'label' => trans('imet-core::v1_evaluation.ImportanceGovernance.fields.Aspect')],
            ['name' => 'EvaluationScore',   'type' => 'rating-0to3WithNA',      'label' => trans('imet-core::v1_evaluation.ImportanceGovernance.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',                   'label' => trans('imet-core::v1_evaluation.ImportanceGovernance.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::v1_evaluation.ImportanceGovernance.predefined_values')
        ];

        $this->module_subTitle = trans('imet-core::v1_evaluation.ImportanceGovernance.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ImportanceGovernance.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ImportanceGovernance.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ImportanceGovernance.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_ImportanceC11',
            'fields' => [
                'Aspect',  'EvaluationScore', 'Comments'
            ]
        ];
    }
}
