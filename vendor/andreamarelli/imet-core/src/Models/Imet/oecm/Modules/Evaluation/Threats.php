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
        $this->module_code = 'C3.1';
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

        return collect($records)
            ->map(function($item){

                $prod = 1
                    * ($item['Impact']!=null ? 4-$item['Impact'] : 1)
                    * ($item['Extension']!=null ? 4-$item['Extension'] : 1)
                    * ($item['Duration']!=null ? 4-$item['Duration'] : 1)
                    * ($item['Trend']!=null ? (5/2 - $item['Trend']*3/4) : 1)
                    * ($item['Probability']!=null ? 4-$item['Probability'] : 1);

                $count = ($item['Impact']!=null ? 1 : 0)
                    + ($item['Extension']!=null ? 1 : 0)
                    + ($item['Duration']!=null ? 1 : 0)
                    + ($item['Trend']!=null ? 1 : 0)
                    + ($item['Probability']!=null ? 1 : 0);

                $item['__score'] = $count>0
                    ? (4 - round(pow($prod, 1/($count)),2))
                    : null;

                return $item;
            })
            ->toArray();
    }

}
