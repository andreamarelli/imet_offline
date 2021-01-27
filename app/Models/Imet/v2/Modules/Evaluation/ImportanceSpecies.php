<?php

namespace App\Models\Imet\v2\Modules\Evaluation;

use App\Models\Imet\v2\Imet;
use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Parent_;

class ImportanceSpecies extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_importance_c13';
    protected $fixed_rows = true;
    protected $validation_3to10 = '';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C1.2';
        $this->module_title = trans('form/imet/v2/evaluation.ImportanceSpecies.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'blade-admin.imet.v2.evaluation.fields.show_species',      'label' => trans('form/imet/v2/evaluation.ImportanceSpecies.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'blade-admin.imet.components.rating-0to3',   'label' => trans('form/imet/v2/evaluation.ImportanceSpecies.fields.EvaluationScore')],
            ['name' => 'SignificativeSpecies',  'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/evaluation.ImportanceSpecies.fields.SignificativeSpecies')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('form/imet/v2/evaluation.ImportanceSpecies.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/evaluation.ImportanceSpecies.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v2/evaluation.ImportanceSpecies.groups.group0'),
            'group1' => trans('form/imet/v2/evaluation.ImportanceSpecies.groups.group1'),
        ];

        $this->module_subTitle = trans('form/imet/v2/evaluation.ImportanceSpecies.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('form/imet/v2/evaluation.ImportanceSpecies.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('form/imet/v2/evaluation.ImportanceSpecies.module_info_Rating');
        $this->ratingLegend = trans('form/imet/v2/evaluation.ImportanceSpecies.ratingLegend');

        $this->validation_3to10 = trans('form/imet/v2/evaluation.ImportanceSpecies.validation_3to10');

        parent::__construct($attributes);

    }

    /**
     * Preload data from CTX
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null) {

        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];
        $preLoaded = [
            'field' => 'Aspect',
            'values' => [
                'group0' => Modules\Context\AnimalSpecies::getModule($form_id)->pluck('species')->toArray(),
                'group1' => Modules\Context\VegetalSpecies::getModule($form_id)->pluck('Species')->toArray()
            ]
        ];
        $module_records['records'] =  static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }

    public static function getVueData($form_id, $collection = null)
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('form/imet/v2/evaluation.ImportanceSpecies.warning_on_save');
        return $vue_data;
    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2) {
            $record = static::addField($record, 'IncludeInStatistics');
        }

        return $record;
    }

    /**
     * Check if the required number of items had been selected
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public static function updateModule(Request $request)
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
    public function isEmptyRecord($record, $foreign_key=null)
    {
        $isEmpty = true;

        if($record['EvaluationScore']!==null
            || $record['SignificativeSpecies']!==null
            || $record['IncludeInStatistics']!==null
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }

}
