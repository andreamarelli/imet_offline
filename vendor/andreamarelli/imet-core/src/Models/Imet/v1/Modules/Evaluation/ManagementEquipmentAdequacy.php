<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ManagementEquipmentAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_management_equipment_adequacy';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'I5';
        $this->module_title = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.title');
        $this->module_fields = [
            ['name' => 'Equipment',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.fields.Equipment')],
            ['name' => 'Importance',  'type' => 'rating-0to2',   'label' => trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.fields.Importance')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Equipment',
            'values' => array_values(trans('imet-core::v1_context.Equipments.groups'))   // Comes from context->Equipments
        ];

        $this->module_info = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.module_info');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ManagementEquipmentAdequacy.ratingLegend');

        parent::__construct($attributes);

    }

    protected static function arrange_records_with_predefined($form_id, $records, $empty_record): array
    {
        $predefined_values = static::getPredefined($form_id);
        $new_records = [];

        if(count($predefined_values['values'])>1 && count($records)==1){
            $records = [];
        }

        $adequacy = static::calculateEquipementAdequacy($form_id);

        foreach($predefined_values['values'] as $p => $predefined_value){
            $new_record = $empty_record;
            foreach($records as $r=>$record){
                if($record[$predefined_values['field']] == $predefined_value){
                    $new_record = $record;
                    unset($records[$r]);
                    break;
                }
            }
            $new_record[$predefined_values['field']] = $predefined_value;
//            $new_record['__adequacy'] = $predefined_values['additional_values'][$p];
            $new_record['__adequacy'] = $adequacy[$p];
            $new_record['__predefined'] = true;
            $new_records[] = $new_record;
        }

        return $new_records;
    }

    private static function calculateEquipementAdequacy($form_id)
    {
        $adequacy = array_keys(trans('imet-core::v1_context.Equipments.groups'));
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
