<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Http\Request;
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
            ['name' => 'Stakeholder',    'type' => 'hidden', 'label' =>''],
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

    public static function updateModule(Request $request): array
    {
        $return = parent::updateModule($request);
        $return['stakeholders_averages'] = static::calculateStakeholdersAverages($return['records'], $return['id']);
        return $return;
    }

    /**
     * Override
     * @param $record
     * @param null $foreign_key
     * @return bool
     */
    public function isEmptyRecord($record, $foreign_key=null): bool
    {
        $isEmpty = true;

        if($record['Dependence']!==null
            || $record['Access']!==null
            || $record['Rivalry']===true
            || $record['Involvement']===true
            || $record['Accountability']===true
            || $record['Orientation']===true
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }

    /**
     * Override: Inject predefined values and replicate for each stakeholder
     *
     * @param $predefined_values
     * @param $records
     * @param $empty_record
     * @return array
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        // inject additional predefined values (first 3 groups) retrieved from CTX
        $predefined_values = (new static())->predefined_values;
        $predefined_values['values']['group0'] =
            Modules\Context\AnimalSpecies::getModule($form_id)->pluck('species')
                ->map(function($item){
                    return Str::contains($item, '|')
                        ? Animal::getScientificName($item)
                        : $item;
                })
                ->toArray();
        $predefined_values['values']['group1'] = Modules\Context\VegetalSpecies::getModule($form_id)->pluck('species')->toArray();
        $predefined_values['values']['group2'] =
            Modules\Context\Habitats::getModule($form_id)->pluck('EcosystemType')
                ->map(function($item){
                    return SelectionList::getList('ImetOECM_Habitats')[$item];
                })
                ->toArray();

        if(!empty($records)) {
            // ensure first record has id field (set to null if doesn't)
            if (!array_key_exists((new static())->primaryKey, $records[0])) {
                $records[0][(new static())->primaryKey] = null;
            }
            // ensure records are empty if the first record is empty (no id)
            if (count($predefined_values['values']) >= 1
                && count($records) == 1
                && $records[0][(new static())->primaryKey] == null
            ) {
                $records = [];
            }
        }

        // retrieve stakeholders
        $stakeholders = StakeholdersNaturalResources::getStakeholders($form_id);
        $weighted_stakeholder = Modules\Context\StakeholdersNaturalResources::calculateWeights($form_id);

        // inject predefined values and replicate for each stakeholder
        $new_records = [];
        foreach($stakeholders as $stakeholder) {
            foreach ($predefined_values['values'] as $g => $group) {
                foreach ($group as $predefined_value) {
                    $new_record = $empty_record;
                    foreach ($records as $r => $record) {
                        if($record['Element'] == $predefined_value
                            && $record['group_key'] == $g
                            && $record['Stakeholder'] == $stakeholder){
                            $new_record = $record;
                            unset($records[$r]);
                            break;
                        }
                    }
                    $new_record['Element'] = $predefined_value;
                    $new_record['group_key'] = $g;
                    $new_record['Stakeholder'] = $stakeholder;
                    $new_record['__predefined'] = true;
                    $new_records[] = $new_record;
                }
            }
        }

        // Add remaining records (without predefined)
        if(count($records)>0){
            foreach($records as $r => $record){
                $new_record = $record;
                $new_record['__predefined'] = false;
                $new_records[] = $record;
            }
        }

        return $new_records;
    }

    public static function calculateStakeholdersAverages($records, $form_id): array
    {
        $weights = Modules\Context\StakeholdersNaturalResources::calculateWeights($form_id);
        foreach($records as $idx => $record){
            $records[$idx]['__stakeholder_weight'] = $weights[$record['Stakeholder']] / 100;
        }

        $values = collect($records)
            ->map(function($item){
                if($item['Dependence']!==null || $item['Access']!==null || $item['Rivalry']!==null){
                    $item['__importance'] = (
                            ($item['Dependence'] ?? 0)
                            + ($item['Access']==='open' ? 3 : ($item['Access']==='exclusion' ? 2 : 0))
                            + ($item['Rivalry'] ? 1 : 0)*2
                        ) * 100 / 8 * $item['__stakeholder_weight'];
                } else {
                    $item['__importance'] = null;
                }
                return $item;
            })
            ->filter(function ($item){
                return $item['__importance'] != null;
            })
            ->groupBy('Element')
            ->map(function($group_values){
                return round($group_values
                    ->map(function($item){
                        return $item['__importance'];
                    })
                    ->average(), 2);
            })
            ->toArray();

        arsort($values);

        return $values;
    }

}
