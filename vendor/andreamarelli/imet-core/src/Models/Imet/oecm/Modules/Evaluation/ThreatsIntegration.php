<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Exception;
use Illuminate\Http\Request;

/**
 * @property $titles
 */
class ThreatsIntegration extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_threats_integration';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\InformationAvailability::class, 'Threat'],
        [Modules\Evaluation\ManagementActivities::class, 'Threat']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3.2';
        $this->module_title = trans('imet-core::oecm_evaluation.ThreatsIntegration.title');
        $this->module_fields = [
            ['name' => 'Threat',           'type' => 'blade-imet-core::oecm.evaluation.fields.threat_with_ranking',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Threat')],
            ['name' => 'Integration',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Integration')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Threat',
            'values' => trans('imet-core::oecm_lists.Threats')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.ThreatsIntegration.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.ThreatsIntegration.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ThreatsIntegration.ratingLegend');

        parent::__construct($attributes);
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $records = parent::arrange_records($predefined_values, $records, $empty_record);

        $threats_ranking = collect(Threats::calculateRanking($form_id))
            ->pluck('__score', 'Value')
            ->toArray();

        foreach ($records as $index => $record){
            $records[$index]['__score'] = $threats_ranking[$record['Threat']];
        }

        return $records;
    }

}
