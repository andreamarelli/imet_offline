<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class ImportanceClimateChange extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_importance_c15';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.4';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceClimateChange.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceClimateChange.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_evaluation.ImportanceClimateChange.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceClimateChange.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceClimateChange.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => null
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceClimateChange.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceClimateChange.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceClimateChange.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceClimateChange.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Preload data from CTX
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $ctx_records = Modules\Context\ClimateChange::getModule($form_id)
            ->filter(function ($item){
                return $item['Value']!==null;
            })
            ->sortBy('Trend');

        // Filter first 10
        if(count($ctx_records)>10){
            $max_allowed_rank = array_values($ctx_records->toArray())[9]['Trend'];
            $ctx_records = $ctx_records
                ->filter(function ($item) use ($max_allowed_rank){
                    return $item['Trend'] <= $max_allowed_rank;
                });
        }

        $records = $module_records['records'];
        $preLoaded = [
            'field' => 'Aspect',
            'values' => $ctx_records
                ->map(function ($item){
                    return $item['Value'];
                })
        ];
        $module_records['records'] =  static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('imet-core::v2_evaluation.ImportanceClimateChange.warning_on_save');
        return $vue_data;
    }

    public static function updateModule(Request $request): array
    {
        static::forceLanguage($request->input('form_id'));

        $records = Payload::decode($request->input('records_json'));
        $form_id = $request->input('form_id');

        static::dropFromDependencies($form_id, $records, [
            Modules\Evaluation\InformationAvailability::class,
            Modules\Evaluation\KeyConservationTrend::class,
            Modules\Evaluation\ManagementActivities::class,
            Modules\Evaluation\ClimateChangeMonitoring::class
        ]);

        return parent::updateModule($request);
    }

}
