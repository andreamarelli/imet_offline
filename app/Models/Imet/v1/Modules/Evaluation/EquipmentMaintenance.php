<?php

namespace App\Models\Imet\v1\Modules\Evaluation;

use App\Models\Imet\v1\Modules;

class EquipmentMaintenance extends Modules\Component\ImetModule_Eval
{ 
    protected $table = 'imet.eval_equipment_maintenance';
    
    public function __construct(array $attributes = []) {
    
        $this->module_type = 'TABLE';
        $this->module_code = 'PR6';
        $this->module_title = trans('form/imet/v1/evaluation.EquipmentMaintenance.title');
        $this->module_fields = [
            ['name' => 'Equipment',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.EquipmentMaintenance.fields.Equipment')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('form/imet/v1/evaluation.EquipmentMaintenance.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('form/imet/v1/evaluation.EquipmentMaintenance.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v1/evaluation.EquipmentMaintenance.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Equipment',
            'values' => array_values(trans('form/imet/v1/context.Equipments.groups'))   // Comes from context->Equipments
        ];

        $this->module_info_EvaluationQuestion = trans('form/imet/v1/evaluation.EquipmentMaintenance.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v1/evaluation.EquipmentMaintenance.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v1/evaluation.EquipmentMaintenance.ratingLegend');
        
        parent::__construct($attributes);
     
    }
}