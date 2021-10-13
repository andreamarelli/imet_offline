<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class EcosystemServices extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_ecosystem_services';

    public static $groupByCategory = [
        ['group0', 'group1', 'group2'],
        ['group3', 'group4'],
        ['group5', 'group6', 'group7', 'group8'],
        ['group9']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 7.1';
        $this->module_title = trans('imet-core::v2_context.EcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Element',               'type' => 'text-area',          'label' => trans('imet-core::v2_context.EcosystemServices.fields.Element')],
            ['name' => 'Importance',            'type' => 'toggle-ImetV2_EcosystemServicesImportance',   'label' => trans('imet-core::v2_context.EcosystemServices.fields.Importance')],
            ['name' => 'ImportanceRegional',    'type' => 'blade-imet-core::components.rating-0to3',   'label' => trans('imet-core::v2_context.EcosystemServices.fields.ImportanceRegional')],
            ['name' => 'ImportanceGlobal',      'type' => 'blade-imet-core::components.rating-Minus2to2',   'label' => trans('imet-core::v2_context.EcosystemServices.fields.ImportanceGlobal')],
            ['name' => 'Observations',          'type' => 'text-area',          'label' => trans('imet-core::v2_context.EcosystemServices.fields.Observations')],
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group0'),
                'group1' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group1'),
                'group2' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group2'),
                'group3' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group3'),
                'group4' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group4'),
                'group5' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group5'),
                'group6' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group6'),
                'group7' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group7'),
                'group8' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group8'),
                'group9' => trans('imet-core::v2_context.EcosystemServices.predefined_values.group9'),
            ]
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.EcosystemServices.groups.group0'),
            'group1' => trans('imet-core::v2_context.EcosystemServices.groups.group1'),
            'group2' => trans('imet-core::v2_context.EcosystemServices.groups.group2'),
            'group3' => trans('imet-core::v2_context.EcosystemServices.groups.group3'),
            'group4' => trans('imet-core::v2_context.EcosystemServices.groups.group4'),
            'group5' => trans('imet-core::v2_context.EcosystemServices.groups.group5'),
            'group6' => trans('imet-core::v2_context.EcosystemServices.groups.group6'),
            'group7' => trans('imet-core::v2_context.EcosystemServices.groups.group7'),
            'group8' => trans('imet-core::v2_context.EcosystemServices.groups.group8'),
            'group9' => trans('imet-core::v2_context.EcosystemServices.groups.group9'),
        ];


        $this->module_info = trans('imet-core::v2_context.EcosystemServices.module_info');
        $this->ratingLegend = trans('imet-core::v2_context.EcosystemServices.ratingLegend');
        parent::__construct($attributes);

    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['groupByCategory'] = static::$groupByCategory;
        $vue_data['warning_on_save'] =  trans('imet-core::v2_context.EcosystemServices.warning_on_save');
        return $vue_data;
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.0 -> v2.0b  ####
        $record = static::dropIfPredefinedValueObsolete($record, 'Element', 'other');
        $record = static::dropIfPredefinedValueObsolete($record, 'Element', 'other - legal');
        $record = static::dropIfPredefinedValueObsolete($record, 'Element', 'other - illegal');

        return $record;
    }

    public static function updateModule(Request $request): array
    {
        static::forceLanguage($request->input('form_id'));

        $records = json_decode($request->input('records_json'), true);
        $form_id = $request->input('form_id');

        static::dropFromDependencies($form_id, $records, [
            Modules\Evaluation\ImportanceEcosystemServices::class,
            Modules\Evaluation\InformationAvailability::class,
            Modules\Evaluation\KeyConservationTrend::class,
            Modules\Evaluation\ManagementActivities::class,
            Modules\Evaluation\EcosystemServices::class,
        ]);

        return parent::updateModule($request);
    }

    public static function getStats($form_id)
    {
        $records = static::getModuleRecords($form_id)['records'];
        $category_stats = [];

        foreach (static::$groupByCategory as $category_index=>$groups){
            $category_sum = 0;
            $category_count = 0;
            foreach ($records as $record){
                if(in_array($record['group_key'], $groups)){
                    $row_stats = static::row_stats($record);
                    if($row_stats!==null){
                        $category_sum += floatval($row_stats);
                        $category_count++;
                    }
                }
            }
            $category_stats[$category_index] = $category_sum>0 ? (($category_sum/$category_count)*100/3.0) : null;
        }
        return $category_stats;
    }

    private static function row_stats($record){
        $stat = null;
        if($record['Importance']!==null && $record['ImportanceRegional']!==null && $record['ImportanceGlobal']!==null){
            $stat = floatval($record['Importance'])
                + (floatval($record['ImportanceRegional'])/3)
                + ((2-floatval($record['ImportanceGlobal']))/4);
        }
        return $stat;
    }

}
