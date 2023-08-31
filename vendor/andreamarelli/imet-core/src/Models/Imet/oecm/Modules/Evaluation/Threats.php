<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Services\StakeholdersService;
use AndreaMarelli\ImetCore\Services\ThreatsService;

class Threats extends Modules\Component\ImetModule_Eval {

    protected $table = 'imet_oecm.eval_threats';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3.1.2';
        $this->module_title = trans('imet-core::oecm_evaluation.Threats.title');
        $this->module_fields = [
            ['name' => 'Value',         'type' => 'disabled', 'label' => trans('imet-core::oecm_evaluation.Threats.fields.Value')],
            ['name' => 'Impact',        'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Impact')],
            ['name' => 'Extension',     'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Extension')],
            ['name' => 'Duration',      'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Duration')],
            ['name' => 'Trend',         'type' => 'imet-core::rating-Minus2to2',   'label' => trans('imet-core::oecm_evaluation.Threats.fields.Trend')],
            ['name' => 'Probability',   'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Probability')],
        ];

        $this->predefined_values = [
            'field' => 'Value',
            'values' => trans('imet-core::oecm_lists.Threats')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Threats.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.Threats.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Threats.ratingLegend');

        parent::__construct($attributes);
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $records = parent::arrange_records($predefined_values, $records, $empty_record);

        $stakeholder_records = StakeholdersService::getAllRecords($form_id);
        $threats = StakeholdersService::keyElementsByThreat($stakeholder_records);

        // Inject num stakeholders and elements
        foreach ($records as $index => $record){
            $threat_key = array_search($record['Value'], trans('imet-core::oecm_lists.Threats'));

            $records[$index]['__count_stakeholders_direct'] = null;
            $records[$index]['__count_stakeholders_indirect'] = null;
            $records[$index]['__elements_legal_list'] = null;
            $records[$index]['__elements_illegal_list'] = null;
            $records[$index]['__threat_key'] = $threat_key;

            if(array_key_exists($threat_key, $threats)){
                $records[$index]['__count_stakeholders_direct'] = $threats[$threat_key]['count_stakeholders_direct'];
                $records[$index]['__count_stakeholders_indirect'] = $threats[$threat_key]['count_stakeholders_indirect'];
                $records[$index]['__elements_legal_list'] = $threats[$threat_key]['elements_legal_list'];
                $records[$index]['__elements_illegal_list'] = $threats[$threat_key]['elements_illegal_list'];
            }

        }

        return $records;
    }

    /**
     * Calculate threat's ranking
     *
     * @param $form_id
     * @param $records
     * @return array
     */
    public static function calculateRanking($form_id, $records = null): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        return ThreatsService::calculateRanking($records);
    }

}
