<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EquipmentMaintenance;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\StaffCompetence;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\StakeholderCooperation;

trait Process
{
    protected static function score_pr1($imet_id): ?float
    {
        $records = StaffCompetence::getModuleRecords($imet_id)['records'];
        return _Common::score_staff($imet_id, $records);
    }

    protected static function score_pr5($imet_id): ?float
    {
        $records = EquipmentMaintenance::getModule($imet_id);

        $values = $records
            ->map(function($record){
                $record['numerator'] = $record['EvaluationScore']==="-99" || $record['EvaluationScore']===null
                    ? null
                    : intval($record['EvaluationScore']) * $record['AdequacyLevel'];
                $record['denominator'] = $record['EvaluationScore']==="-99" || $record['EvaluationScore']===null
                    ? null
                    : $record['AdequacyLevel'];
                $record['denominator'] = $record['denominator'] ?? 0;
                return $record;
            });

        $numerator = $values->sum('numerator');
        $denominator = $values->sum('denominator');

        $score = $denominator>0
            ? $numerator / $denominator / 3 * 100
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_pr9($imet_id): ?float
    {
        $records = StakeholderCooperation::getModuleRecords($imet_id)['records'];

        $values = collect($records)
            ->filter(function ($record){
                return $record['Weight'] !== null
                    && $record['Cooperation'] !== null
                    && $record['Cooperation'] !== '-99';
            });

        $numerator = $values->sum(function ($item){
            return $item['Cooperation'] * $item['Weight'];
        });
        $denominator = $values->sum('Weight');

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

}
