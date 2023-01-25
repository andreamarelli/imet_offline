<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V2;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\ManagementStaff;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Equipments;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\BudgetAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\BudgetSecurization;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\ManagementEquipmentAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\Staff;

trait Inputs
{

    protected static function score_i2($imet_id): ?float
    {
        $functions = Staff::getModule($imet_id)
            ->pluck('StaffCapacityAdequacy', 'Theme')
            ->toArray();

        $values = ManagementStaff::getModule($imet_id)
            ->filter(function ($item) use($functions){
                return in_array($item['Function'], array_keys($functions));
            })
            ->sortBy('Function')
            ->groupBy('Function')
            ->map(function($group, $key) use ($functions){
                $sum_actual =  $group->sum('ActualPermanent');
                $sum_actual = $sum_actual===0 ? null : $sum_actual;
                $sum_expected =  $group->sum('ExpectedPermanent');
                $sum_expected = $sum_expected===0 ? null : $sum_expected;
                $ratio = $sum_actual!==null & $sum_expected!==null
                    ? $sum_actual / $sum_expected
                    : null;
                return $ratio===null || $functions[$key]===null
                    ? 0
                    : ceil($ratio * 5 - 1) * $functions[$key];
            });

        return $values->count()>0
            ? round($values->sum() / (12 * $values->count()) * 100 , 2)
            : null;
    }

    protected static function score_i3($imet_id)
    {
        $records = BudgetAdequacy::getModule($imet_id)
            ->toArray();

        $value = !empty($records)
            ? (int) $records[0]['EvaluationScore']
            : null;

        if($value===0){
            $score = 0;
        } elseif($value===1){
            $score = 12.5;
        } elseif($value===2){
            $score = 37.5;
        } elseif($value===3){
            $score = 60;
        } elseif($value===4){
            $score = 80;
        } elseif($value===5){
            $score = 100;
        } else {
            $score = null;
        }
        return $score!==null
            ? floatval($score)
            : null;
    }

    protected static function score_i4($imet_id): ?float
    {
        $records = BudgetSecurization::getModule($imet_id)
            ->toArray();
        $record = $records[0] ?? null;

        $score = $record!==null && $record['Percentage']!==null && $record['EvaluationScore']!==null
            ? (
                $record['Percentage'] / 5 +
                $record['EvaluationScore'] / 3
            ) / 2 * 100
        : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_i5($imet_id): ?float
    {
        $equipment = Equipments::getModule($imet_id)
            ->groupBy('group_key')
            ->map(function($group) {
                $group_values = $group
                    ->pluck('AdequacyLevel')
                    ->toArray();
                return !empty($group_values)
                    ? static::average($group_values, null)
                    : null;
            });

        $equipment_adequacy = ManagementEquipmentAdequacy::getModule($imet_id)
            ->map(function($record){
                $record['Importance'] = $record['Importance']!==null
                    ? floatval($record['Importance'])
                    : 1;

                return $record;
            })
            ->pluck('Importance', 'Equipment');

        $values = $equipment->map(function ($item, $index) use ($equipment_adequacy){
            $importance = $equipment_adequacy[$index] ?? null;
            $imp_p1 = $importance + 1;
            $eq_imp = $imp_p1 * $item;

            return [
                'group_key' => $index,
                'AdequacyLevel' => $item,
                'imp_p1' => $imp_p1,
                'eq_imp' => $eq_imp
            ];
        });

        $numerator = $values->sum('eq_imp');
        $denominator = $values->sum('imp_p1');

        $score = $denominator>0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

}