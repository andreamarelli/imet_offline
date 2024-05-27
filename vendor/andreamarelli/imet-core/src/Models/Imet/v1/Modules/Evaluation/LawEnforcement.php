<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class LawEnforcement extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_law_enforcement';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR10';
        $this->module_title = trans('imet-core::v1_evaluation.LawEnforcement.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.LawEnforcement.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.LawEnforcement.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.LawEnforcement.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => trans('imet-core::v1_evaluation.LawEnforcement.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.LawEnforcement.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.LawEnforcement.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.LawEnforcement.ratingLegend');

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
            'table' => 'Eval_LawEnforcement',
            'fields' => [
                'Element',  'EvaluationScore', 'Comments'
            ]
        ];
    }
}
