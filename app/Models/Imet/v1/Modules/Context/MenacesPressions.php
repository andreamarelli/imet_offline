<?php

namespace App\Models\Imet\v1\Modules\Context;

use App\Models\Imet\v1\Modules;

class MenacesPressions extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_menaces_pressions';

    public static $groupByCategory = [
            ['group0'],
            ['group1', 'group2', 'group3', 'group4', 'group5'],
            ['group6'],
            ['group7'],
            ['group8', 'group9', 'group10', 'group11'],
            ['group12'],
            ['group13', 'group14', 'group15'],
            ['group16'],
            ['group17', 'group18', 'group19', 'group20', 'group21', 'group22'],
            ['group23'],
            ['group24'],
            ['group25'],
        ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 5.1';
        $this->module_title = trans('form/imet/v1/context.MenacesPressions.title');
        $this->module_fields = [
            ['name' => 'Value',         'type' => 'text-area',               'label' => trans('form/imet/v1/context.MenacesPressions.fields.Value')],
            ['name' => 'Impact',        'type' => 'rating-0to3',        'label' => trans('form/imet/v1/context.MenacesPressions.fields.Impact')],
            ['name' => 'Extension',     'type' => 'rating-0to3',        'label' => trans('form/imet/v1/context.MenacesPressions.fields.Extension')],
            ['name' => 'Duration',      'type' => 'rating-0to3',        'label' => trans('form/imet/v1/context.MenacesPressions.fields.Duration')],
            ['name' => 'Trend',         'type' => 'rating-Minus2to2',   'label' => trans('form/imet/v1/context.MenacesPressions.fields.Trend')],
            ['name' => 'Probability',   'type' => 'rating-0to3',        'label' => trans('form/imet/v1/context.MenacesPressions.fields.Probability')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v1/context.MenacesPressions.groups.group0'),
            'group1' => trans('form/imet/v1/context.MenacesPressions.groups.group1'),
            'group2' => trans('form/imet/v1/context.MenacesPressions.groups.group2'),
            'group3' => trans('form/imet/v1/context.MenacesPressions.groups.group3'),
            'group4' => trans('form/imet/v1/context.MenacesPressions.groups.group4'),
            'group5' => trans('form/imet/v1/context.MenacesPressions.groups.group5'),
            'group6' => trans('form/imet/v1/context.MenacesPressions.groups.group6'),
            'group7' => trans('form/imet/v1/context.MenacesPressions.groups.group7'),
            'group8' => trans('form/imet/v1/context.MenacesPressions.groups.group8'),
            'group9' => trans('form/imet/v1/context.MenacesPressions.groups.group9'),
            'group10' => trans('form/imet/v1/context.MenacesPressions.groups.group10'),
            'group11' => trans('form/imet/v1/context.MenacesPressions.groups.group11'),
            'group12' => trans('form/imet/v1/context.MenacesPressions.groups.group12'),
            'group13' => trans('form/imet/v1/context.MenacesPressions.groups.group13'),
            'group14' => trans('form/imet/v1/context.MenacesPressions.groups.group14'),
            'group15' => trans('form/imet/v1/context.MenacesPressions.groups.group15'),
            'group16' => trans('form/imet/v1/context.MenacesPressions.groups.group16'),
            'group17' => trans('form/imet/v1/context.MenacesPressions.groups.group17'),
            'group18' => trans('form/imet/v1/context.MenacesPressions.groups.group18'),
            'group19' => trans('form/imet/v1/context.MenacesPressions.groups.group19'),
            'group20' => trans('form/imet/v1/context.MenacesPressions.groups.group20'),
            'group21' => trans('form/imet/v1/context.MenacesPressions.groups.group21'),
            'group22' => trans('form/imet/v1/context.MenacesPressions.groups.group22'),
            'group23' => trans('form/imet/v1/context.MenacesPressions.groups.group23'),
            'group24' => trans('form/imet/v1/context.MenacesPressions.groups.group24'),
            'group25' => trans('form/imet/v1/context.MenacesPressions.groups.group25'),
        ];

        $this->predefined_values = [
            'field' => 'Value',
            'values' => [
                'group0' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group0'),
                'group1' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group1'),
                'group2' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group2'),
                'group3' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group3'),
                'group4' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group4'),
//                'group5' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group5'),
                'group6' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group6'),
                'group7' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group7'),
                'group8' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group8'),
                'group9' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group9'),
                'group10' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group10'),
                'group11' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group11'),
                'group12' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group12'),
                'group13' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group13'),
                'group14' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group14'),
//                'group15' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group15'),
                'group16' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group16'),
                'group17' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group17'),
                'group18' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group18'),
                'group19' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group19'),
                'group20' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group20'),
                'group21' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group21'),
                'group22' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group22'),
                'group23' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group23'),
                'group24' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group24'),
                'group25' => trans('form/imet/v1/context.MenacesPressions.predefined_values.group25'),
            ]
        ];
        $this->ratingLegend = trans('form/imet/v1/context.MenacesPressions.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getDefinitions($form_id = null)
    {
        $definitions = parent::getDefinitions($form_id);
        $definitions['groupByCategory'] = static::$groupByCategory;
        return $definitions;
    }

    public static function getStats($form_id)
    {
        $records = static::getModuleRecords($form_id)['records'];
        $fields = ['Impact', 'Extension', 'Duration', 'Trend', 'Probability'];

        // ### row stats ###
        $row_stats = [];
        foreach ($records as $record){
            $valuesByRecord = [];
            foreach ($fields as $field){
                $valuesByRecord[] = $record[$field];
            }
            $row_stats[$record[static::$group_key_field]][] = static::calculateStats($valuesByRecord, true);
        }

        // ### group stats ###
        $group_stats = [];
        foreach ($row_stats as $group=>$values){
            $group_stats[$group] = static::calculateStats($values);
        }

        // ### category stats ###
        $category_stats = [];
        $valuesByCategory = [];
        foreach (static::$groupByCategory as $index=>$groups){
            $valuesByCategory[$index] = [];
            foreach ($groups as $group){
                $valuesByCategory[$index][] = array_key_exists($group, $group_stats) ? $group_stats[$group] : null;
            }
        }
        foreach ($valuesByCategory as $values){
            $category_stats[] = static::calculateStats($values);
        }


        return [
            'row_stats' => $row_stats,
            'group_stats' => $group_stats,
            'category_stats' => $category_stats,
        ];
    }

    private static function calculateStats($values, $rows=false)
    {
        $numCategories = 4;
        $prod = 1;
        $count = 0;

        foreach ($values as $index=>$value){
            if($value!==null){
                if($index===3 && $rows===true){
                    $prod *= ($numCategories+1)/2 - $value*($numCategories-1)/4;
                } else {
                    $prod *= $numCategories - $value;
                }
                $count++;
            }
        }

        return $count>0
            ? (4 - round(pow($prod, 1/($count)),2))
            : null;
    }

}