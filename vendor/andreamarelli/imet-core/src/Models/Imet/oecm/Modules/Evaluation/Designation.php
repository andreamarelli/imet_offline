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
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect']
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

    /**
     * Preload data
     *
     * @param $predefined_values
     * @param $records
     * @param $empty_record
     * @return array
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $designations = Modules\Context\SpecialStatus::getModule($form_id)->pluck('Designation')->toArray();
        $preLoaded = [
            'field' => 'Aspect',
            'values' => array_filter($designations)
        ];

        return parent::arrange_records($preLoaded, $records, $empty_record);
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

}
