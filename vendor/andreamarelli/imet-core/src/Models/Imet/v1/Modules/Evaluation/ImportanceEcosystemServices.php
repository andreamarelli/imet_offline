<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ImportanceEcosystemServices extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_importance_c16';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.6';
        $this->module_title = trans('imet-core::v1_evaluation.ImportanceEcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ImportanceEcosystemServices.fields.Aspect')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ImportanceEcosystemServices.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::v1_evaluation.ImportanceEcosystemServices.predefined_values')
        ];

        $this->module_info = trans('imet-core::v1_evaluation.ImportanceEcosystemServices.module_info');
        $this->module_subTitle = trans('imet-core::v1_evaluation.ImportanceEcosystemServices.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ImportanceEcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ImportanceEcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ImportanceClimateChange.ratingLegend');

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
                'Aspect', 'Comments'
            ]
        ];
    }
}
