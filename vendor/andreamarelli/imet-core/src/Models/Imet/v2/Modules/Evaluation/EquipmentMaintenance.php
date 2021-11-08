<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class EquipmentMaintenance extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_equipment_maintenance';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR6';
        $this->module_title = trans('imet-core::v2_evaluation.EquipmentMaintenance.title');
        $this->module_fields = [
            ['name' => 'Equipment',         'type' => 'text-area',                'label' => trans('imet-core::v2_evaluation.EquipmentMaintenance.fields.Equipment')],
            ['name' => 'AdequacyLevel',     'type' => 'disabled',             'label' => trans('imet-core::v2_evaluation.EquipmentMaintenance.fields.AdequacyLevel')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.EquipmentMaintenance.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',                'label' => trans('imet-core::v2_evaluation.EquipmentMaintenance.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Equipment',                                                         // Comes from context->Equipments
            'values' => array_keys(trans('imet-core::v2_context.Equipments.groups')),
            'labels' => array_values(trans('imet-core::v2_context.Equipments.groups'))
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.EquipmentMaintenance.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.EquipmentMaintenance.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.EquipmentMaintenance.ratingLegend');

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
                $records[$i]['AdequacyLevel'] = $adequacy[$i];
                $new_records[] = $records[$i];
            }
        }

        return $new_records;
    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record = static::dropField($record, 'Percentage');
//        $record = static::addField($record, 'AdequacyLevel');
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
            $result[] = $adequacy[$i]['count']>0
                ? round($adequacy[$i]['sum']/$adequacy[$i]['count'],2)
                : null;
        }

        return $result;
    }
}
