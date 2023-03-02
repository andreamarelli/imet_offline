<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class StakeholdersNaturalResources extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_stakeholders_natural_resources';
    protected $fixed_rows = false;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 3.1.1';
        $this->module_title = trans('imet-core::oecm_context.StakeholdersNaturalResources.title');
        $this->module_fields = [
            ['name' => 'Element',                'type' => 'text-area', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'GeographicalProximity',  'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.GeographicalProximity')],
            ['name' => 'Engagement',             'type' => 'dropdown_multiple-ImetOECM_Engagement', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Engagement')],
            ['name' => 'Impact',                 'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Impact')],
            ['name' => 'Role',                   'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Role')],

            ['name' => 'InvolvementM',     'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.InvolvementM')],
            ['name' => 'InvolvementME', 'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.InvolvementME')],
            ['name' => 'InvolvementE',     'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.InvolvementE')],
            ['name' => 'InvolvementCAE',     'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.InvolvementCAE')],

            ['name' => 'Comments',               'type' => 'text-area', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_context.StakeholdersNaturalResources.groups');
        $this->module_info = trans('imet-core::oecm_context.StakeholdersNaturalResources.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.StakeholdersNaturalResources.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('imet-core::oecm_context.StakeholdersNaturalResources.warning_on_save');
        return $vue_data;
    }

    public static function updateModule(Request $request): array
    {
        // get request
        $records = Payload::decode($request->input('records_json'));

        // Remove all empty records: where "Element" is empty
        foreach ($records as $index => $record){
            if($record['Element']===null || trim($record['Element'])===''){
                unset($records[$index]);
            }
        }

        // Execute update
        $request->merge(['records_json' => Payload::encode($records)]);
        return parent::updateModule($request);
    }


    public static function calculateWeights($form_id){
        $records = static::getModuleRecords($form_id)['records'];

        $records = collect($records)->map(function($item){

            $Engagement = !empty($item['Engagement']) ? json_decode($item['Engagement']) : null;
            $Engagement = is_array($Engagement) ? count($Engagement) : null;

            $sum = $item['Impact']!==null ? $item['Impact'] : 0;
            $sum += $item['Role']!==null ? $item['Role'] : 0;
            $sum += $Engagement ?? 0;
            $sum += $item['GeographicalProximity'] ? 4 : 0;
            $sum += $item['InvolvementM'] ? 1 : 0;
            $sum += $item['InvolvementME'] ? 1 : 0;
            $sum += $item['InvolvementE'] ? 1 : 0;
            $sum += $item['InvolvementCAE'] ? 1 : 0;

            $item['__weight'] = round($sum * 100 / 20, 0);

            return $item;
        })->pluck('__weight', 'Element')->toArray();

        return $records;
    }
}
