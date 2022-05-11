<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

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
        $this->module_title = trans('imet-core::v2_context.MenacesPressions.title');
        $this->module_fields = [
            ['name' => 'Value',         'type' => 'text-area',               'label' => trans('imet-core::v2_context.MenacesPressions.fields.Value')],
            ['name' => 'Impact',        'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::v2_context.MenacesPressions.fields.Impact')],
            ['name' => 'Extension',     'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::v2_context.MenacesPressions.fields.Extension')],
            ['name' => 'Duration',      'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::v2_context.MenacesPressions.fields.Duration')],
            ['name' => 'Trend',         'type' => 'imet-core::rating-Minus2to2',   'label' => trans('imet-core::v2_context.MenacesPressions.fields.Trend')],
            ['name' => 'Probability',   'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::v2_context.MenacesPressions.fields.Probability')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.MenacesPressions.groups.group0'),
            'group1' => trans('imet-core::v2_context.MenacesPressions.groups.group1'),
            'group2' => trans('imet-core::v2_context.MenacesPressions.groups.group2'),
            'group3' => trans('imet-core::v2_context.MenacesPressions.groups.group3'),
            'group4' => trans('imet-core::v2_context.MenacesPressions.groups.group4'),
            'group5' => trans('imet-core::v2_context.MenacesPressions.groups.group5'),
            'group6' => trans('imet-core::v2_context.MenacesPressions.groups.group6'),
            'group7' => trans('imet-core::v2_context.MenacesPressions.groups.group7'),
            'group8' => trans('imet-core::v2_context.MenacesPressions.groups.group8'),
            'group9' => trans('imet-core::v2_context.MenacesPressions.groups.group9'),
            'group10' => trans('imet-core::v2_context.MenacesPressions.groups.group10'),
            'group11' => trans('imet-core::v2_context.MenacesPressions.groups.group11'),
            'group12' => trans('imet-core::v2_context.MenacesPressions.groups.group12'),
            'group13' => trans('imet-core::v2_context.MenacesPressions.groups.group13'),
            'group14' => trans('imet-core::v2_context.MenacesPressions.groups.group14'),
            'group15' => trans('imet-core::v2_context.MenacesPressions.groups.group15'),
            'group16' => trans('imet-core::v2_context.MenacesPressions.groups.group16'),
            'group17' => trans('imet-core::v2_context.MenacesPressions.groups.group17'),
            'group18' => trans('imet-core::v2_context.MenacesPressions.groups.group18'),
            'group19' => trans('imet-core::v2_context.MenacesPressions.groups.group19'),
            'group20' => trans('imet-core::v2_context.MenacesPressions.groups.group20'),
            'group21' => trans('imet-core::v2_context.MenacesPressions.groups.group21'),
            'group22' => trans('imet-core::v2_context.MenacesPressions.groups.group22'),
            'group23' => trans('imet-core::v2_context.MenacesPressions.groups.group23'),
            'group24' => trans('imet-core::v2_context.MenacesPressions.groups.group24'),
            'group25' => trans('imet-core::v2_context.MenacesPressions.groups.group25'),
        ];

        $this->predefined_values = [
            'field' => 'Value',
            'values' => [
                'group0' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group0'),
                'group1' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group1'),
                'group2' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group2'),
                'group3' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group3'),
                'group4' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group4'),
//                'group5' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group5'),
                'group6' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group6'),
                'group7' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group7'),
                'group8' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group8'),
                'group9' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group9'),
                'group10' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group10'),
                'group11' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group11'),
                'group12' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group12'),
                'group13' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group13'),
                'group14' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group14'),
//                'group15' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group15'),
                'group16' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group16'),
                'group17' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group17'),
                'group18' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group18'),
                'group19' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group19'),
                'group20' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group20'),
                'group21' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group21'),
                'group22' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group22'),
                'group23' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group23'),
                'group24' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group24'),
                'group25' => trans('imet-core::v2_context.MenacesPressions.predefined_values.group25'),
            ]
        ];
        $this->ratingLegend = trans('imet-core::v2_context.MenacesPressions.ratingLegend');
        $this->module_info = trans('imet-core::v2_context.MenacesPressions.module_info');

        parent::__construct($attributes);
    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['groupByCategory'] = static::$groupByCategory;
        $vue_data['warning_on_save'] =  trans('imet-core::v2_context.MenacesPressions.warning_on_save');
        return $vue_data;
    }

    public static function updateModule(Request $request): array
    {
        static::forceLanguage($request->input('form_id'));

        $records = json_decode($request->input('records_json'), true);
        $form_id = $request->input('form_id');

        static::dropFromDependencies($form_id, $records, [
            Modules\Evaluation\Menaces::class,
            Modules\Evaluation\InformationAvailability::class,
            Modules\Evaluation\KeyConservationTrend::class,
            Modules\Evaluation\ManagementActivities::class,
        ]);

        return parent::updateModule($request);
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = static::replacePredefinedValue($record, 'Value', 'Other: Increased rainfall and seasonal changes', 'Increased rainfall and seasonal changes');
        $record = static::replacePredefinedValue($record, 'Value', 'Other: Outros: Aumento da precipitação e mudanças sazonais', 'Aumento da precipitação e mudanças sazonais');
        $record = static::replacePredefinedValue($record, 'Value', 'Otro: Aumento de las precipitaciones y cambios estacionales', 'Aumento de las precipitaciones y cambios estacionales');
        $record = static::replacePredefinedValue($record, 'Value', 'Renewable energies', 'Renewable abiotic energy use');
        // TODO: "Renewable energies" to "Renewable abiotic energy use" for FR, PT and SP

        return $record;
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
            $stat = static::calculateStats($values);
            $category_stats[] = $stat>0 ? round($stat*100/3,2): '';
        }

        return [
            'row_stats' => $row_stats,
            'group_stats' => $group_stats,
            'category_stats' => $category_stats,
        ];
    }

    public static function calculateStats($values, $rows=false)
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

    public static function get_marine_predefined(): array
    {
        $predefined = (new static())->predefined_values['values'];
        return [
            $predefined['group0'][4],
            $predefined['group0'][5],
            $predefined['group7'][2],
            $predefined['group7'][3],
            $predefined['group7'][4],
            $predefined['group12'][5],
            $predefined['group12'][6],
            $predefined['group12'][7],
            $predefined['group12'][8],
        ];
    }

    public static function get_terrestrial_groups(): array
    {
        $groups = (new static())->module_groups;
        return [
            $groups['group1'],
            $groups['group2'],
            $groups['group3'],
            $groups['group8'],
            $groups['group9']
        ];
    }

    public static function get_marine_groups(): array
    {
        $groups = (new static())->module_groups;
        return [
            $groups['group4'],
            $groups['group11']
        ];
    }

}
