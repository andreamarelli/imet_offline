<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class StaffCompetence extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_staff_competence';
    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR1';
        $this->module_title = trans('imet-core::v2_evaluation.StaffCompetence.title');
        $this->module_fields = [
            ['name' => 'Theme',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.StaffCompetence.fields.Theme')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_evaluation.StaffCompetence.fields.EvaluationScore')],
            ['name' => 'PercentageLevel',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_evaluation.StaffCompetence.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.StaffCompetence.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Theme',
            'values' => null
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.StaffCompetence.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.StaffCompetence.module_info_Rating');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.StaffCompetence.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.StaffCompetence.ratingLegend');

        $this->max_rows = 14;

        parent::__construct($attributes);

    }

    /**
     * Inject num of current staff from CTX (ManagementStaff)
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);
        $staff_records = Modules\Context\ManagementStaff::getModule($form_id);

        $module_records['records'] = collect($module_records['records'])
            ->map(function ($item) use ($staff_records){
                $st = $staff_records
                    ->filter(function ($item_staff) use($item){
                        return $item_staff['Function']===$item['Theme'];
                    })
                    ->first();
                $item['__num_staff'] = $st!==null ? intval($st->ActualPermanent) : null;
                return $item;
            });

        return $module_records;
    }

    protected static function getPredefined($form_id = null)
    {
        $predefined_values = (new static())->predefined_values;

        if($form_id!==null){
            $collection = Modules\Context\ManagementStaff::getModule($form_id);
            $predefined_values['values'] = $collection->pluck('Function')->toArray();
        }

        return $predefined_values;
    }

}
