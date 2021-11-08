<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


class ObjectivesSpecies extends _Objectives
{
    protected $table = 'imet.eval_objectives_c13';

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'C1.2';
        $this->module_info = trans('imet-core::v2_evaluation.ObjectivesSpecies.module_info');

        parent::__construct($attributes);
    }
}
