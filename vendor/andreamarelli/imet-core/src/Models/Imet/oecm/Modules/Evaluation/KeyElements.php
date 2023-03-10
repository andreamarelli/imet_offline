<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class KeyElements extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_key_elements';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C2';
        $this->module_title = trans('imet-core::oecm_evaluation.KeyElements.title');
        $this->module_fields = [
            ['name' => 'Aspect',                'type' => 'blade-imet-core::oecm.evaluation.fields.key_elements_element',      'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Aspect')],
            ['name' => 'Importance',            'type' => 'disabled',      'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Importance')],
            ['name' => 'EvaluationScore',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Comments')],
        ];

        $this->module_subTitle = trans('imet-core::oecm_evaluation.KeyElements.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.KeyElements.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.KeyElements.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Preload data from CTX 5.1
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

        // Retrieve key elements (and importance calculation) form CTX
        $key_elements =  collect(static::getKeyElementsFromCTX($form_id))->keyBy('element');

        // Inject key elements
        $predefined = [
            'field' => 'Aspect',
            'values' => $key_elements->pluck('element')->toArray()
        ];
        $module_records['records'] = static::arrange_records($predefined, $records, $empty_record);

        // Inject also importance
        foreach ($module_records['records'] as $index => $record){
            if(array_key_exists($record['Aspect'], $key_elements->toArray())){
                $module_records['records'][$index]['Importance'] = $key_elements[$record['Aspect']]['importance'];
                $module_records['records'][$index]['__percentage_stakeholders'] = $key_elements[$record['Aspect']]['stakeholder_count'];
            }
        }


        return $module_records;
    }

    public static function getKeyElementsFromCTX($form_id): array
    {
        $ctx5_key_elements = Modules\Context\AnalysisStakeholderAccessGovernance::calculateKeyElementsImportances( $form_id);
        $ctx6_key_elements = Modules\Context\AnalysisStakeholderTrendsThreats::calculateKeyElementsImportances2($form_id);

        $ctx5_key_elements = collect($ctx5_key_elements)->keyBy('element')->toArray();
        $ctx6_key_elements = collect($ctx6_key_elements)->keyBy('element')->toArray();

        $key_elements = collect();
        foreach ($ctx5_key_elements as $key => $ctx5_key_element){
            if(array_key_exists($key, $ctx6_key_elements)){
                $importance = ($ctx5_key_element['importance'] + (100 - $ctx6_key_elements[$key]['importance'])) / 2;
                $stakeholder_count = $ctx6_key_elements[$key]['stakeholder_count'];
            }
            $key_elements->push([
                'element' => $key,
                'importance' => $importance ? round($importance, 2): null,
                'stakeholder_count' => $stakeholder_count ?? null,
            ]);
        }

        return $key_elements
            ->sortByDesc('importance')
            ->filter(function ($item){
                return $item['importance']!==null;
            })
            ->toArray();
    }
}
