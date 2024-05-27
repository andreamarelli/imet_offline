<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class Menaces extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_menaces';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Aspect';
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect'],
    ];

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
     * Prefill from CTX
     */
    protected static function getPredefined($form_id = null): array
    {
        return [
            'field' => static::$DEPENDENCY_ON,
            'values' =>  $form_id !== null
                ? static::getMenacesPressions($form_id)
                    ->map(function ($item){
                        return $item['Value'];
                    })
                : []
        ];
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $records  = parent::arrange_records($predefined_values, $records, $empty_record);
        $form_id = $empty_record['FormID'];

        // Inject rankings
        foreach (static::getMenacesPressions($form_id)->values()->toArray() as $index=>$record){
            $records[$index]['_rank'] =  -$record['_rank']*100/3.0;
            $records[$index]['_Impact'] = $record['Impact'];
            $records[$index]['_Extension'] = $record['Extension'];
            $records[$index]['_Duration'] = $record['Duration'];
            $records[$index]['_Trend'] = $record['Trend'];
            $records[$index]['_Probability'] = $record['Probability'];
        }

        return $records;
    }


    private static function getMenacesPressions($form_id){
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

        return $ctx_records;
    }


}
