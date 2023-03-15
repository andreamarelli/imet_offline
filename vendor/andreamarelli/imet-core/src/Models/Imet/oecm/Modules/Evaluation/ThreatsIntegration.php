<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

/**
 * @property $titles
 */
class ThreatsIntegration extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_threats_integration';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C4.2';
        $this->module_title = trans('imet-core::oecm_evaluation.ThreatsIntegration.title');
        $this->module_fields = [
            ['name' => 'Threat',           'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Threat')],
            ['name' => 'Integration',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Integration')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Threat',
            'values' => trans('imet-core::oecm_lists.MainThreat')
        ];

        $this->ratingLegend = trans('imet-core::oecm_evaluation.ThreatsIntegration.ratingLegend');

        parent::__construct($attributes);
    }


}
