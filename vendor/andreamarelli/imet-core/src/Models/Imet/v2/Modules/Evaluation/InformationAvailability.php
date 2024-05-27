<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class InformationAvailability extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_information_availability';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Element';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'I1';
        $this->module_title = trans('imet-core::v2_evaluation.InformationAvailability.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'blade-imet-core::v2.evaluation.fields.show_species',   'label' => trans('imet-core::v2_evaluation.InformationAvailability.fields.Element')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_evaluation.InformationAvailability.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.InformationAvailability.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group1'),
            'group2' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group2'),
            'group3' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group3'),
            'group4' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group4'),
            'group5' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group5')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.InformationAvailability.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.InformationAvailability.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.InformationAvailability.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Prefill from CTX
     */
    protected static function getPredefined($form_id = null): array
    {
        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? [
                    'group0' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'] && $item['group_key']==="group0";
                    })->pluck('Aspect')->toArray(),
                    'group1' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'] && $item['group_key']==="group1";
                    })->pluck('Aspect')->toArray(),
                    'group2' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                    'group3' => Modules\Evaluation\Menaces::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                    'group4' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                    'group5' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item){
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                ]
                : []
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
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }


}
