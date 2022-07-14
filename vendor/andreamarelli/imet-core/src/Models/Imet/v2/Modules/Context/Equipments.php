<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class Equipments extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_equipments';
//    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 3.3';
        $this->module_title = trans('imet-core::v2_context.Equipments.title');
        $this->module_fields = [
            ['name' => 'Resource',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Equipments.fields.Resource')],
            ['name' => 'AdequacyLevel',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_context.Equipments.fields.AdequacyLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Equipments.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Resource',
            'values' => [
                'group0' => trans('imet-core::v2_context.Equipments.predefined_values.group0'),
                'group1' => trans('imet-core::v2_context.Equipments.predefined_values.group1'),
                'group2' => trans('imet-core::v2_context.Equipments.predefined_values.group2'),
                'group3' => trans('imet-core::v2_context.Equipments.predefined_values.group3'),
                'group4' => trans('imet-core::v2_context.Equipments.predefined_values.group4'),
                'group5' => trans('imet-core::v2_context.Equipments.predefined_values.group5'),
                'group6' => trans('imet-core::v2_context.Equipments.predefined_values.group6'),
                'group7' => trans('imet-core::v2_context.Equipments.predefined_values.group7'),
                'group8' => trans('imet-core::v2_context.Equipments.predefined_values.group8'),
                'group9' => trans('imet-core::v2_context.Equipments.predefined_values.group9'),
                'group10' =>trans('imet-core::v2_context.Equipments.predefined_values.group10'),
                'group11' =>trans('imet-core::v2_context.Equipments.predefined_values.group11'),
                'group12' =>trans('imet-core::v2_context.Equipments.predefined_values.group12')
            ]
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.Equipments.groups.group0'),
            'group1' => trans('imet-core::v2_context.Equipments.groups.group1'),
            'group2' => trans('imet-core::v2_context.Equipments.groups.group2'),
            'group3' => trans('imet-core::v2_context.Equipments.groups.group3'),
            'group4' => trans('imet-core::v2_context.Equipments.groups.group4'),
            'group5' => trans('imet-core::v2_context.Equipments.groups.group5'),
            'group6' => trans('imet-core::v2_context.Equipments.groups.group6'),
            'group7' => trans('imet-core::v2_context.Equipments.groups.group7'),
            'group8' => trans('imet-core::v2_context.Equipments.groups.group8'),
            'group9' => trans('imet-core::v2_context.Equipments.groups.group9'),
            'group10' => trans('imet-core::v2_context.Equipments.groups.group10'),
            'group11' => trans('imet-core::v2_context.Equipments.groups.group11'),
            'group12' => trans('imet-core::v2_context.Equipments.groups.group12'),
        ];

        $this->ratingLegend = trans('imet-core::v2_context.Equipments.ratingLegend');

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.0 -> v2.0b  ####
        $record = static::replacePredefinedValue($record, 'Resource', 'Hydraulic electric facility', 'Hydropower electric facility');

        return $record;
    }

    public static function getAverages($form_id){
        $records = Equipments::getModuleRecords($form_id)['records'];

        $averages = [];
        foreach (array_keys((new Equipments())->module_groups) as $group){
            $sum = $count = 0;
            foreach ($records as $record){
                if($record['group_key'] === $group && $record['AdequacyLevel']!==null){
                    $sum += (integer) $record['AdequacyLevel'];
                    $count++;
                }
            }
            $averages[] = $count>0 ? round($sum/$count, 2) : 0;
        }
        return $averages;
    }
}
