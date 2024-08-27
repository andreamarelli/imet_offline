<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class StaffCompetence extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_staff_competence';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Theme';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR1';
        $this->module_title = trans('imet-core::v2_evaluation.StaffCompetence.title');
        $this->module_fields = [
            ['name' => 'Theme',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.StaffCompetence.fields.Theme')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.StaffCompetence.fields.EvaluationScore')],
            ['name' => 'PercentageLevel',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.StaffCompetence.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.StaffCompetence.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Theme',
            'values' => null
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.StaffCompetence.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.StaffCompetence.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.StaffCompetence.ratingLegend');

        $this->max_rows = 14;

        parent::__construct($attributes);

    }

    /**
     * Prefill from CTX
     */
    protected static function getPredefined($form_id = null): ?array
    {
        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? Modules\Context\ManagementStaff::getModule($form_id)->pluck('Function')->toArray()
                : []
        ];
    }

    /**
     * Inject num of current staff from CTX (ManagementStaff)
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $records = parent::arrange_records($predefined_values, $records, $empty_record);
        $form_id = $empty_record['FormID'];

        $staff_records = Modules\Context\ManagementStaff::getModule($form_id);

        return collect($records)
            ->map(function ($item) use ($staff_records){
                $st = $staff_records
                    ->filter(function ($item_staff) use($item){
                        return $item_staff['Function']===$item['Theme'];
                    })
                    ->first();
                $item['__num_staff'] = $st!==null ? intval($st->ActualPermanent) : null;
                return $item;
            })
            ->toArray();
    }

}
