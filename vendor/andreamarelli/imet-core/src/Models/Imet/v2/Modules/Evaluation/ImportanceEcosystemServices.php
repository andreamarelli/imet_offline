<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class ImportanceEcosystemServices extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_importance_c16';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Aspect';
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect'],
        [Modules\Evaluation\EcosystemServices::class, 'Aspect'],
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.5';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.title');
        $this->module_fields = [
            ['name' => 'Aspect', 'type' => 'blade-imet-core::v2.evaluation.fields.importance_ecosystem_services_aspect',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceEcosystemServices.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => null
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceEcosystemServices.ratingLegend');

        parent::__construct($attributes);
    }


    /**
     * Prefill from CTX
     */
    protected static function getPredefined($form_id = null): ?array
    {
        return [
            'field' => static::$DEPENDENCY_ON,
            'values' =>  $form_id !== null
                ? static::getEcosystemServices($form_id)
                    ->map(function ($item){
                        return $item['Element'];
                    })
                : []
        ];
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $records  = parent::arrange_records($predefined_values, $records, $empty_record);
        $form_id = $empty_record['FormID'];

        // Inject rankings
        foreach (static::getEcosystemServices($form_id)->values()->toArray() as $index=>$record){
            $records[$index]['_rank'] = $record['_rank'];
            $records[$index]['_Importance'] = $record['Importance'];
            $records[$index]['_ImportanceRegional'] = $record['ImportanceRegional'];
            $records[$index]['_ImportanceGlobal'] = $record['ImportanceGlobal'];
        }

        return $records;
    }

    private static function getEcosystemServices($form_id){
        return Modules\Context\EcosystemServices::getModule($form_id)
            ->filter(function ($item){
                return $item['Importance']!==null;
            })
            ->map(function ($item){
                $item['_rank'] = (floatval($item['Importance'])
                        + ($item['ImportanceRegional']/3)
                        + ((2-$item['ImportanceGlobal'])/4)) /3 * 100;
                return $item;
            })
            ->sortByDesc('_rank');
    }

}
