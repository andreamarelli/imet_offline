<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class StakeholderCooperation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_stakeholder_cooperation';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR8';
        $this->module_title = trans('imet-core::oecm_evaluation.StakeholderCooperation.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'disabled',           'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'Weight',            'type' => 'disabled',           'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Weight')],
            ['name' => 'Cooperation',       'type' => 'imet-core::rating-0to3WithNA',  'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Cooperation')],
            ['name' => 'Comments',          'type' => 'text-area',          'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_context.StakeholdersNaturalResources.groups');        // Re-use groups from CTX 3.1.2
        $this->titles = trans('imet-core::oecm_context.StakeholdersNaturalResources.titles');               // Re-use titles from CTX 3.1.2

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.StakeholderCooperation.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.StakeholderCooperation.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Preload data from CTX 3.1.2
     *
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
            'field' => 'Element',
            'values' => Modules\Context\StakeholdersNaturalResources::getStakeholders($form_id, true)
        ];

        $module_records['records'] = static::arrange_records($preLoaded, $records, $empty_record);

        $weight = Modules\Context\StakeholdersNaturalResources::calculateWeights($form_id);

        foreach($module_records['records'] as $idx => $module_record){
            if(array_key_exists($module_record['Element'], $weight)){
                $module_records['records'][$idx]['Weight'] = $weight[$module_record['Element']];
            } else {
                $module_records['records'][$idx]['Weight'] = null;
            }
        }
        return $module_records;
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

        if($record['Element']!==null){
            $isEmpty = false;
        }

        return $isEmpty;
    }

}
