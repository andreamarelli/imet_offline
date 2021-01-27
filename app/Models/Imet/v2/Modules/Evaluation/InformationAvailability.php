<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Modules;

class InformationAvailability extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_information_availability';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'I1';
        $this->module_title = trans('form/imet/v2/evaluation.InformationAvailability.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'blade-admin.imet.v2.evaluation.fields.show_species',   'label' => trans('form/imet/v2/evaluation.InformationAvailability.fields.Element')],
            ['name' => 'EvaluationScore',  'type' => 'blade-admin.imet.components.rating-0to3',   'label' => trans('form/imet/v2/evaluation.InformationAvailability.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.InformationAvailability.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v2/evaluation.InformationAvailability.groups.group0'),
            'group1' => trans('form/imet/v2/evaluation.InformationAvailability.groups.group1'),
            'group2' => trans('form/imet/v2/evaluation.InformationAvailability.groups.group2'),
            'group3' => trans('form/imet/v2/evaluation.InformationAvailability.groups.group3'),
            'group4' => trans('form/imet/v2/evaluation.InformationAvailability.groups.group4'),
            'group5' => trans('form/imet/v2/evaluation.InformationAvailability.groups.group5')
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.InformationAvailability.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.InformationAvailability.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.InformationAvailability.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Preload data from CTX
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null) {

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
    public function isEmptyRecord($record, $foreign_key=null)
    {
        $isEmpty = true;

        if($record['EvaluationScore']!==null
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }


    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::dropField($record, 'PercentageLevel');
        }

        return $record;
    }

}
