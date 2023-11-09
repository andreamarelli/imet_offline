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

    protected static $DEPENDENCY_ON = 'Aspect';
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\Objectives::class, 'Aspect'],
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C4';
        $this->module_title = trans('imet-core::oecm_evaluation.KeyElements.title');
        $this->module_fields = [
            ['name' => 'Aspect',                'type' => 'blade-imet-core::oecm.evaluation.fields.key_elements_element',      'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Aspect')],
            ['name' => 'Importance',            'type' => 'disabled',      'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Importance')],
            ['name' => 'EvaluationScore',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Comments')],
        ];


        $this->module_groups = trans('imet-core::oecm_evaluation.KeyElements.groups');

        $this->module_subTitle = trans('imet-core::oecm_evaluation.KeyElements.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.KeyElements.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.KeyElements.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.KeyElements.ratingLegend');

        parent::__construct($attributes);
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

        if($record['EvaluationScore']!==null
            || ($record['IncludeInStatistics']!==null && $record['IncludeInStatistics']!==false)
            || $record['Comments']!==null
            || ($record['group_key']==='group0' && $record['Importance']!==null)
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }

    /**
     * Preload data from CTX 5.1
     *
     * @param $predefined_values
     * @param $records
     * @param $empty_record
     * @return array
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        // Retrieve key elements (and importance calculation) form CTX
        $key_elements = collect(Modules\Context\AnalysisStakeholderDirectUsers::calculateKeyElementsImportances($form_id))
            ->keyBy('element');
        $biodiversity_key_elements =  collect(Modules\Evaluation\ThreatsBiodiversity::calculateRanking($form_id))
            ->sortBy('_score');
        $biodiversity_key_elements_scores = $biodiversity_key_elements->pluck('__score', 'Criteria')->toArray();

        // Set predefines values (key elements)
        $predefined = [
            'field' => 'Aspect',
            'values' => [
                'group0' => $key_elements->pluck('element')->toArray(),
                'group1' => $biodiversity_key_elements->pluck('Criteria')->toArray(),
            ]
        ];

        $records = parent::arrange_records($predefined, $records, $empty_record);

        foreach ($records as $index => $record){
            // Inject also importance
            if($record['group_key']==='group0' && array_key_exists($record['Aspect'], $key_elements->toArray())){
                $records[$index]['Importance'] = $key_elements[$record['Aspect']]['importance'];
                $records[$index]['__num_stakeholders_direct'] = $key_elements[$record['Aspect']]['stakeholder_direct_count'];
                $records[$index]['__num_stakeholders_indirect'] = $key_elements[$record['Aspect']]['stakeholder_indirect_count'];
                $records[$index]['__group_stakeholders'] = $key_elements[$record['Aspect']]['group'];
                $records[$index]['__score'] = null;

            // Inject score
            } else if($record['group_key']==='group1'){
                // Discard items not existing in CTX 4 -> C3.1.1
                if(!array_key_exists($record['Aspect'], $biodiversity_key_elements_scores)){
                    unset($records[$index]);
                    continue;
                }
                $records[$index]['__score'] = $biodiversity_key_elements_scores[$record['Aspect']];
                $records[$index]['Importance'] = null;
                $records[$index]['__num_stakeholders_direct'] = null;
                $records[$index]['__num_stakeholders_indirect'] = null;
                $records[$index]['__group_stakeholders'] = null;
            }
        }

        return $records;
    }

    /**
     * Provide the list of prioritized key elements
     * @param $form_id
     * @return array
     */
    public static function getPrioritizedElements($form_id): array {
        return collect(static::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Aspect')
            ->toArray();
    }

    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = static::getModule($form_id)
            ->where('IncludeInStatistics', true)
            ->pluck($dependency_on)
            ->toArray();
        $updated_values = collect($records)
            ->where('IncludeInStatistics', true)
            ->pluck($dependency_on)
            ->toArray();

        // Make diff to find out what to drop
        $to_be_dropped = array_diff($existing_values, $updated_values);
        return array_values($to_be_dropped);
    }

}
