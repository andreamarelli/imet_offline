<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class ImportanceHabitats extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_importance_c14';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Aspect';
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect'],
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.3';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceHabitats.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'blade-imet-core::v2.evaluation.fields.key_element',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.EvaluationScore')],
            ['name' => 'EvaluationScore2',  'type' => 'rating-1to3',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.EvaluationScore2')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.Comments')],
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceHabitats.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceHabitats.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceHabitats.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceHabitats.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Prefill from CTX
     */
    protected static function getPredefined($form_id = null): ?array
    {
        $predefined_values = $form_id!==null
            ? Modules\Context\Habitats::getModule($form_id)->pluck('EcosystemType')->toArray()
            : [];

        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $predefined_values
        ];
    }

    /**
     * Override
     * @param $record
     * @param null $foreign_key
     * @return bool
     */
    public function isEmptyRecord($record, $foreign_key=null): bool
    {
        $isEmpty = true;

        if($record['EvaluationScore']!==null
            || $record['EvaluationScore2']!==null
            || $record['IncludeInStatistics']!==null
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }

}
