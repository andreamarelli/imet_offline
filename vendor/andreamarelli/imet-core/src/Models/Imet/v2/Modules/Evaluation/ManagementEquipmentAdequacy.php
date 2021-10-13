<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class ManagementEquipmentAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_management_equipment_adequacy';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'I5';
        $this->module_title = trans('imet-core::v2_evaluation.ManagementEquipmentAdequacy.title');
        $this->module_fields = [
            ['name' => 'Equipment',  'type' => 'blade-imet-core::v2.evaluation.fields.management_equipment_adequacy_equipment',   'label' => trans('imet-core::v2_evaluation.ManagementEquipmentAdequacy.fields.Equipment')],
            ['name' => 'EvaluationScore',  'type' => 'blade-imet-core::v2.evaluation.fields.management_equipment_adequacy_evaluationscore',   'label' => trans('imet-core::v2_evaluation.ManagementEquipmentAdequacy.fields.EvaluationScore')],
            ['name' => 'Importance',  'type' => 'blade-imet-core::components.rating-0to2',   'label' => trans('imet-core::v2_evaluation.ManagementEquipmentAdequacy.fields.Importance')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ManagementEquipmentAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Equipment',                                                         // Comes from context->Equipments
            'values' => array_keys(trans('imet-core::v2_context.Equipments.groups')),
            'labels' => array_values(trans('imet-core::v2_context.Equipments.groups'))
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ManagementEquipmentAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ManagementEquipmentAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ManagementEquipmentAdequacy.ratingLegend');

        parent::__construct($attributes);
    }


    protected static function arrange_records_with_predefined($form_id, $records, $empty_record): array
    {
        $predefined_values = static::getPredefined($form_id);
        $records = static::arrange_records($predefined_values, $records, $empty_record);

        $new_records = [];

        $adequacy = static::calculateEquipementAdequacy($form_id);
        foreach($predefined_values['values'] as $i => $predefined_value){
            if($adequacy[$i]!=null){
                $records[$i]['__adequacy'] = $adequacy[$i];
                $new_records[] = $records[$i];
            }
        }

        return $new_records;
    }


//    public static function convert_v1_to_v2($record)
//    {
//        $record = static::addField($record, 'EvaluationScore');
//        return $record;
//    }

    private static function calculateEquipementAdequacy($form_id)
    {
        $adequacy = array_keys(trans('imet-core::v2_context.Equipments.groups'));
        $adequacy = array_fill_keys($adequacy, [
            'sum' => 0,
            'count' => 0
        ]);
        $collection = Modules\Context\Equipments::getModule($form_id);
        foreach ($collection as $item){
            if($item['AdequacyLevel']!==null){
                $adequacy[$item['group_key']]['sum'] += $item['AdequacyLevel'];
                $adequacy[$item['group_key']]['count']++;
            }
        }

        $result = [];
        foreach($adequacy as $i=>$v){
            $result[] = $adequacy[$i]['count']>0 ? round($adequacy[$i]['sum']/$adequacy[$i]['count'],2) : null;
        }

        return $result;
    }

}
