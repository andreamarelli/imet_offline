<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Http\Request;

class Menaces extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_menaces';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3';
        $this->module_title = trans('imet-core::v2_evaluation.Menaces.title');
        $this->module_fields = [
            ['name' => 'Aspect',                'type' => 'blade-imet-core::v2.evaluation.fields.menaces_aspect',   'label' => trans('imet-core::v2_evaluation.Menaces.fields.Aspect')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.Menaces.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.Menaces.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => null
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.Menaces.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.Menaces.module_info_Rating');

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

        // retrieve from CTX
        $ctx_records = Modules\Context\MenacesPressions::getModule($form_id)
            ->map(function ($item){
                $item['_rank'] = Modules\Context\MenacesPressions::calculateStats(
                    [$item['Impact'], $item['Extension'], $item['Duration'], $item['Trend'], $item['Probability']],
                    true
                );
                return $item;
            })
            ->sortByDesc('_rank');

        // Filter first 10
        if(count($ctx_records)>10) {
            $max_allowed_rank = array_values($ctx_records->toArray())[9]['_rank'];
            $ctx_records = $ctx_records
                ->filter(function ($item) use ($max_allowed_rank) {
                    return $item['_rank'] >= $max_allowed_rank;
                });
        }

        // Populate predefined with values from CTX
        $preLoaded = [
            'field' => 'Aspect',
            'values' => $ctx_records
                ->map(function ($item){
                    return $item['Value'];
                })
                ->toArray()

        ];
        $module_records['records'] =  static::arrange_records($preLoaded, $module_records['records'], $empty_record);

        // Inject also ranking
        foreach (array_values($ctx_records->toArray()) as $index=>$record){
            $module_records['records'][$index]['_rank'] =  -$record['_rank']*100/3.0;
            $module_records['records'][$index]['_Impact'] = $record['Impact'];
            $module_records['records'][$index]['_Extension'] = $record['Extension'];
            $module_records['records'][$index]['_Duration'] = $record['Duration'];
            $module_records['records'][$index]['_Trend'] = $record['Trend'];
            $module_records['records'][$index]['_Probability'] = $record['Probability'];
        }

        return $module_records;
    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data['warning_on_save'] =  trans('imet-core::v2_evaluation.Menaces.warning_on_save');
        return $vue_data;
    }



    public static function updateModule(Request $request): array
    {
        static::forceLanguage($request->input('form_id'));

        $records = json_decode($request->input('records_json'), true);
        $form_id = $request->input('form_id');

        static::dropFromDependencies($form_id, $records, [
            Modules\Evaluation\InformationAvailability::class,
            Modules\Evaluation\KeyConservationTrend::class,
            Modules\Evaluation\ManagementActivities::class,
        ]);

        return parent::updateModule($request);
    }
}
