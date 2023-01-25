<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class KeyConservationTrend extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_key_conservation_trends';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'O/C2';
        $this->module_title = trans('imet-core::v2_evaluation.KeyConservationTrend.title');
        $this->module_fields = [
            ['name' => 'Element',   'type' => 'blade-imet-core::v2.evaluation.fields.show_species',           'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Element')],
            ['name' => 'Condition', 'type' => 'imet-core::rating-Minus3to3WithNA',    'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Condition')],
            ['name' => 'Trend',     'type' => 'imet-core::rating-Minus3to3WithNA',    'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Trend')],
            ['name' => 'Reliability',  'type' => 'dropdown-ImetV2_SpeciesReliability',   'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Comments',  'type' => 'text-area',           'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group1'),
            'group2' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group2'),
            'group3' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group3'),
            'group4' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group4'),
            'group5' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group5'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.KeyConservationTrend.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.KeyConservationTrend.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.KeyConservationTrend.ratingLegend');


        parent::__construct($attributes);

    }

    /**
     * Preload data from CTX
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {

        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];
        $preLoaded = [
            'field' => 'Element',
            'values' => [
                'group0' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item){
                    return $item['IncludeInStatistics'] && $item['group_key']==="group0";
                })->pluck('Aspect')->toArray(),
                'group1' =>Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item){
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
        ];

        $module_records['records'] =  static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
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

        if($record['Condition']!==null
            || $record['Trend']!==null
            || $record['Reliability']!==null
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }

}
