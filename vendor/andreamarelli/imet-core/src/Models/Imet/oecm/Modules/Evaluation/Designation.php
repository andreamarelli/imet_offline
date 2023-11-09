<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Exception;
use Illuminate\Http\Request;

class Designation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.designation';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Objectives::class, 'Aspect'],
        [Modules\Evaluation\InformationAvailability::class, 'Aspect']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1';
        $this->module_title = trans('imet-core::oecm_evaluation.Designation.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.EvaluationScore')],
            ['name' => 'SignificativeClassification',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.SignificativeClassification')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.Comments')],
        ];

        $this->module_subTitle = trans('imet-core::oecm_evaluation.Designation.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Designation.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Designation.ratingLegend');

        parent::__construct($attributes);
    }

    protected static function getPredefined($form_id = null): array
    {
        return [
            'field' => 'Aspect',
            'values' => $form_id !== null
                ? array_filter(Modules\Context\SpecialStatus::getModule($form_id)->pluck('Designation')->toArray())
                : []
        ];
    }

    /**
     * Provide the list of prioritized key elements
     * @param $form_id
     * @return array
     */
    public static function getPrioritizedElements($form_id): array
    {
        return collect(static::getModuleRecords($form_id)['records'])
            ->filter(function ($item) {
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
