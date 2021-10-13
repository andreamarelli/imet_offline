<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class EquipmentMaintenance extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_equipment_maintenance';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR6';
        $this->module_title = trans('imet-core::v1_evaluation.EquipmentMaintenance.title');
        $this->module_fields = [
            ['name' => 'Equipment',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.EquipmentMaintenance.fields.Equipment')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.EquipmentMaintenance.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.EquipmentMaintenance.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.EquipmentMaintenance.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Equipment',
            'values' => array_values(trans('imet-core::v1_context.Equipments.groups'))   // Comes from context->Equipments
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.EquipmentMaintenance.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.EquipmentMaintenance.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.EquipmentMaintenance.ratingLegend');

        parent::__construct($attributes);

    }
}
