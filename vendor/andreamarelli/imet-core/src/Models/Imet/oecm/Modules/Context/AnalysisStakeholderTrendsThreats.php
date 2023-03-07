<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;

/**
 * @property $titles
 */
class AnalysisStakeholderTrendsThreats extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_analysis_stakeholders_trends_threats';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 6.1';
        $this->module_title = trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.title');
        $this->module_fields = [
            ['name' => 'Element',       'type' => 'disabled', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Status',        'type' => 'imet-core::rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Status')],
            ['name' => 'Trend',         'type' => 'imet-core::rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Trend')],
            ['name' => 'MainThreat',    'type' => 'dropdown-ImetOECM_MainThreat', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.MainThreat')],
            ['name' => 'ClimateChangeEffect',    'type' => 'imet-core::rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.ClimateChangeEffect')],
            ['name' => 'Comments',      'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.fields.Comments')],
            ['name' => 'Stakeholder',    'type' => 'disabled', 'label' =>''],
        ];

        $this->module_groups = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.groups');     // Re-use groups from CTX 5.1
        $this->titles = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles');            // Re-use titles from CTX 5.1

        $this->module_info = trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.ratingLegend');

        parent::__construct($attributes);
    }

    public function isEmptyRecord($record, $foreign_key=null): bool
    {
        $isEmpty = true;

        if($record['Status']!==null
            || $record['Trend']!==null
            || $record['MainThreat']!==null
            || $record['ClimateChangeEffect']!==null
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

    public static function calculateStakeholdersAverages($records, $form_id): array
    {
        $values = [

        ];

        return $values;
    }

}
