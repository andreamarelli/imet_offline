<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

/**
 * @property $titles
 */
class AnalysisStakeholderTrendsThreats extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_analysis_stakeholders_trends_threats';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Stakeholder';
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\KeyElements::class, 'Element']
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 6';
        $this->module_title = trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.title');
        $this->module_fields = [
            ['name' => 'Element',       'type' => 'disabled', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Status',        'type' => 'imet-core::rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Status')],
            ['name' => 'Trend',         'type' => 'imet-core::rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Trend')],
            ['name' => 'MainThreat',    'type' => 'dropdown_multiple-ImetOECM_MainThreat', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.MainThreat')],
            ['name' => 'Comments',      'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Comments')],
            ['name' => 'Stakeholder',    'type' => 'hidden', 'label' =>''],
        ];

        $this->module_groups = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.groups');     // Re-use groups from CTX 5.1
        $this->titles = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles');            // Re-use titles from CTX 5.1

        $this->module_info = trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.ratingLegend');

        parent::__construct($attributes);
    }

    public static function updateModule(Request $request): array
    {
        $return = parent::updateModule($request);
        $return['key_elements_importance'] = static::calculateKeyElementsImportances2( $return['id'], $return['records']);
        return $return;
    }

    public function isEmptyRecord($record, $foreign_key=null): bool
    {
        $isEmpty = true;

        if($record['Status']!==null
            || $record['Trend']!==null
            || $record['MainThreat']!==null
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        // inject predefined values and replicate for each stakeholder
        $ctx5_records = Modules\Context\AnalysisStakeholderAccessGovernance::getModule($form_id);

        $new_records = [];
        foreach ($ctx5_records as $ctx5_record){
            $new_record = $empty_record;
            foreach ($records as $r => $record) {
                // record already there
                if($record['Element'] === $ctx5_record['Element']
                    && $record['group_key'] == $ctx5_record['group_key']
                    && $record['Stakeholder'] == $ctx5_record['Stakeholder']){
                    $new_record = $record;
                    unset($records[$r]);
                    break;
                }
            }
            $new_record['Element'] = $ctx5_record['Element'];
            $new_record['group_key'] = $ctx5_record['group_key'];
            $new_record['Stakeholder'] = $ctx5_record['Stakeholder'];
            $new_record['__predefined'] = true;
            $new_records[] = $new_record;
        }

        return $new_records;
    }

    public static function calculateKeyElementsImportances2($form_id, $records = null): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        $weights = Modules\Context\StakeholdersNaturalResources::calculateWeights($form_id);
        $num_stakeholders = count($weights);
        $weights_sum = collect($weights)->sum();
        $weights_div = $weights_sum>0 ?
            collect($weights)->map(function($item) use($weights_sum){
                return $item / $weights_sum;
            })->toArray()
            : null;

        foreach($records as $idx => $record){
            $records[$idx]['__stakeholder_weight'] = $weights_div[$record['Stakeholder']] ?? null;
        }

        return collect($records)
            ->filter(function ($item){
                return !(new static())->isEmptyRecord($item);
            })
            ->groupBy('Element')
            ->map(function($group, $stakeholder) use ($num_stakeholders){

                $sum_weights = $group->pluck('__stakeholder_weight')->sum();

                $status = $sum_weights>0
                    ? $group->map(function($item){
                        return $item['__stakeholder_weight'] * ($item['Status'] * 25 + 50);
                    })->sum() / $sum_weights
                    : null;

                $trend = $sum_weights>0
                    ? $group->map(function($item){
                        return $item['__stakeholder_weight'] * ($item['Trend'] * 25 + 50);
                    })->sum() / $sum_weights
                    : null;

                $stakeholder_count = $group->count();

                return [
                    'element' => $stakeholder,
                    'status' => $status!==null ? round($status, 1) : null,
                    'trend' => $trend!==null ? round($trend, 1) : null,
                    'importance' => $status!==null && $trend!==null ? round(($status + $trend) / 2, 2) : null,
                    'stakeholder_count' => $stakeholder_count,
                    'group' => trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.groups.'.$group[0]['group_key'])
                ];
            })
            ->filter(function($item){
                return $item['importance']!==null;
            })
            ->sortByDesc('importance')
            ->values()
            ->toArray();
    }

    public static function getNumStakeholdersElementsByThreat($form_id): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        $threats = [];
        foreach($records as $record){
            if($record['MainThreat']!==null){
                foreach (json_decode($record['MainThreat']) as $threat){
                    if(!array_key_exists($threat, $threats)){
                        $threats[$threat] = [];
                    }
                    if(!array_key_exists($record['Element'], $threats[$threat])){
                        $threats[$threat][$record['Element']] = 1;
                    } else {
                        $threats[$threat][$record['Element']]++;
                    }
                }
            }
        }
        return $threats;
    }

}
