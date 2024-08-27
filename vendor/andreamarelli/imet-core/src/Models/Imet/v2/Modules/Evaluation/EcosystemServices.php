<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class EcosystemServices extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_ecosystem_services';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Intervention';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR18';
        $this->module_title = trans('imet-core::v2_evaluation.EcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Intervention',      'type' => 'blade-imet-core::v2.evaluation.fields.show',  'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.Intervention')],
            ['name' => 'EvaluationScore',   'type' => 'rating-0to3WithNA',      'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',                   'label' => trans('imet-core::v2_evaluation.EcosystemServices.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.EcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.EcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.EcosystemServices.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Prefill from CTX
     */
    protected static function getPredefined($form_id = null): ?array
    {
        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item){
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray()
                : []
        ];
    }

}
