<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Support\Str;

/**
 * @property $titles
 */
class AnalysisStakeholderAccessGovernance extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_analysis_stakeholders_access_governance';
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 5.1';
        $this->module_title = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.title');
        $this->module_fields = [
            ['name' => 'Element',       'type' => 'blade-imet-core::oecm.context.fields.ctx51_element', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Dependence',    'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.fields.Dependence')],
            ['name' => 'Access',        'type' => 'suggestion-ImetOECM_Access', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.fields.Access')],
            ['name' => 'Rivalry',       'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.fields.Rivalry')],
            ['name' => 'Involvement',   'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.fields.Involvement')],
            ['name' => 'Accountability', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.fields.Accountability')],
            ['name' => 'Orientation',   'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.fields.Orientation')],
            ['name' => 'Comments',      'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.groups');
        $this->titles = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles');
        $this->predefined_values = [
            'field' => 'Element',
            'values' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.predefined_values')
        ];

        $this->module_info = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.ratingLegend');

        parent::__construct($attributes);
    }


    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.warning_on_save');
        return $vue_data;
    }

    /**
     * Preload data from CTX 4.x
     *
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];

        $preLoaded = [
            'field' => 'Element',
            'values' => [
                'group0' => Modules\Context\AnimalSpecies::getModule($form_id)->pluck('species')
                    ->map(function($item){
                        return Str::contains($item, '|')
                            ? Animal::getScientificName($item)
                            : $item;
                    })
                    ->toArray(),
                'group1' => Modules\Context\VegetalSpecies::getModule($form_id)->pluck('species')->toArray(),
                'group2' => Modules\Context\Habitats::getModule($form_id)->pluck('EcosystemType')
                    ->map(function($item){
                        return SelectionList::getList('ImetOECM_Habitats')[$item];
                    })
                    ->toArray(),
            ]
        ];

        $module_records['records'] = static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }

}
