<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Control extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_control';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'PR9';
        $this->module_title = trans('imet-core::v1_evaluation.Control.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'rating-0to4WithNA',   'label' => trans('imet-core::v1_evaluation.Control.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.Control.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Control.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.Control.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.Control.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.Control.ratingLegend');

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
            'table' => 'Eval_Control',
            'fields' => [
                'EvaluationScore', 'Percentage', 'Comments'
            ]
        ];
    }
}
