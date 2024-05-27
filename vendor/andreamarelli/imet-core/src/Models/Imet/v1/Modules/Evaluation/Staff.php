<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Staff extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_staff';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'I2';
        $this->module_title = trans('imet-core::v1_evaluation.Staff.title');
        $this->module_fields = [
            ['name' => 'Theme',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Staff.fields.Theme')],
            ['name' => 'PercentageLevel',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.Staff.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Staff.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Theme',
            'values' => null
        ];

        $this->module_info = trans('imet-core::v1_evaluation.Staff.module_info');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.Staff.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.Staff.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.Staff.ratingLegend');

        $this->max_rows = 14;

        parent::__construct($attributes);
    }

    protected static function getPredefined($form_id = null)
    {
        $predefined_values = parent::getPredefined($form_id);

        if($form_id!==null){
            $collection =  Modules\Context\ManagementStaff::getModule($form_id);
            $predefined_values['values'] = $collection->pluck('Function')->toArray();
            $predefined_values['additional_values'] = $collection->map(function ($item) {
                return static::calculateStaffStatus($item['ActualPermanent'], $item['ExpectedPermanent']);
            })->toArray();
        }

        return $predefined_values;
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $new_records = [];

        if(count($predefined_values['values'])>1 && count($records)==1){
            $records = [];
        }

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
            $new_record['__status'] = $predefined_values['additional_values'][$p];
            $new_record['__predefined'] = true;
            $new_records[] = $new_record;
        }

        return $new_records;
    }

    private static function calculateStaffStatus($actual, $expected)
    {
        $result = null;
        if($actual!==null && $expected!=null){
            $ratio = $actual/$expected;
            if($ratio<0.25){
                $result = 0;
            } elseif($ratio<0.5){
                $result = 1;
            } elseif($ratio<0.75){
                $result = 2;
            } elseif($ratio<=1.25){
                $result = 3;
            } elseif($ratio<=1.5){
                $result = 2;
            } elseif($ratio>1.5){
                $result = 1;
            }
        }
        return $result;
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_Staff',
            'fields' => [
                'Theme', 'PercentageLevel', 'Comments'
            ]
        ];
    }
}
