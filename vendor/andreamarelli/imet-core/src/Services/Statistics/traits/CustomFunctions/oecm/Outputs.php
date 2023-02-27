<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementGovernance;

trait Outputs
{

    protected static function score_op2($imet_id): ?float {
        $records = ManagementGovernance::getModuleRecords($imet_id)['records'];

        $score = $records[0]['Patrol']!==null ?
            $records[0]['Patrol'] * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }
}
