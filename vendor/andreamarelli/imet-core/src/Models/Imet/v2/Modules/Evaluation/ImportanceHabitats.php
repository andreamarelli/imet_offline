<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class ImportanceHabitats extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_importance_c14';
    protected $fixed_rows = true;
    protected $validation_3to10 = '';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C1.3';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceHabitats.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'blade-imet-core::v2.evaluation.fields.show',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'blade-imet-core::components.rating-0to3',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.EvaluationScore')],
            ['name' => 'EvaluationScore2',  'type' => 'blade-imet-core::components.rating-1to3',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.EvaluationScore2')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceHabitats.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.ImportanceHabitats.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.ImportanceHabitats.groups.group1'),
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceHabitats.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceHabitats.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceHabitats.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceHabitats.ratingLegend');

        $this->validation_3to10 = trans('imet-core::v2_evaluation.ImportanceHabitats.validation_3to10');

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

        $records = $module_records['records'];
        $preLoaded = [
            'field' => 'Aspect',
            'values' => [
                'group0' => Modules\Context\Habitats::getModule($form_id)->pluck('EcosystemType')->toArray(),
                'group1' => Modules\Context\LandCover::getModule($form_id)->pluck('CoverType')->toArray()
            ]
        ];
        $module_records['records'] =  static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('imet-core::v2_evaluation.ImportanceHabitats.warning_on_save');
        return $vue_data;
    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record = static::addField($record, 'IncludeInStatistics');
//        return $record;
//    }

    /**
     * Check if the required number of items had been selected
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public static function updateModule(Request $request): array
    {
        static::forceLanguage($request->input('form_id'));

        $records = json_decode($request->input('records_json'), true);
        $form_id = $request->input('form_id');
        $num_valid_records = collect($records)->filter(function($item){
            return $item['IncludeInStatistics'];
        })->count();

        if($num_valid_records>=3 && $num_valid_records<=10){

            static::dropFromDependencies($form_id, $records, [
                Modules\Evaluation\InformationAvailability::class,
                Modules\Evaluation\KeyConservationTrend::class,
                Modules\Evaluation\ManagementActivities::class,
            ]);

            return parent::updateModule($request);
        } else {
            return static::validationErrorResponse([
                'Aspect' => [(new static())->validation_3to10]
            ]);
        }
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
            || $record['EvaluationScore2']!==null
            || $record['IncludeInStatistics']!==null
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }

}
