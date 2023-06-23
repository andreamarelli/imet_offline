<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class AnalysisStakeholdersObjectives extends _Objectives
{
    protected $table = 'imet_oecm.context_stakeholders_analysis_objectives';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_code = 'SA 2.3';
        $this->module_info = trans('imet-core::oecm_context.AnalysisStakeholdersObjectives.module_info');

        parent::__construct($attributes);

    }
}
