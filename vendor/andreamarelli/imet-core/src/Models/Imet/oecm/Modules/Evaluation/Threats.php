<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Threats extends Modules\Component\ImetModule_Eval {

    protected $table = 'imet_oecm.eval_threats';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C4';
        $this->module_title = trans('imet-core::oecm_evaluation.Threats.title');
        $this->module_fields = [
            ['name' => 'Value',         'type' => 'blade-imet-core::oecm.evaluation.fields.threat', 'label' => trans('imet-core::oecm_evaluation.Threats.fields.Value')],
            ['name' => 'Impact',        'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Impact')],
            ['name' => 'Extension',     'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Extension')],
            ['name' => 'Duration',      'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Duration')],
            ['name' => 'Trend',         'type' => 'imet-core::rating-Minus2to2',   'label' => trans('imet-core::oecm_evaluation.Threats.fields.Trend')],
            ['name' => 'Probability',   'type' => 'imet-core::rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Probability')],
        ];

        $this->predefined_values = [
            'field' => 'Value',
            'values' => trans('imet-core::oecm_lists.MainThreat')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Threats.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.Threats.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Threats.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);

        // Retrieve num stakeholder by element by threat
        $threats =  Modules\Context\AnalysisStakeholderTrendsThreats::getNumStakeholdersElementsByThreat($form_id);

        // Inject num stakeholders by elements by threats
        foreach ($module_records['records'] as $index => $record){
            $threat_key = array_search($record['Value'], trans('imet-core::oecm_lists.MainThreat'));
            if(array_key_exists($threat_key, $threats)){
                $module_records['records'][$index]['__num_stakeholders_by_elements'] = $threats[$threat_key];
            } else {
                $module_records['records'][$index]['__num_stakeholders_by_elements'] = null;
            }
        }
        return $module_records;
    }

}
