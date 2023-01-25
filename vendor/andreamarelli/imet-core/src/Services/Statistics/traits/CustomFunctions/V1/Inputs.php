<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V1;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\Equipments;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\ManagementStaff;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\BudgetAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\BudgetSecurization;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\ManagementEquipmentAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\Staff;
use Illuminate\Support\Facades\App;

trait Inputs
{

    public static function staff_weights($imet_id, $staff = null): array
    {
        $records = $staff ?? ManagementStaff::getModule($imet_id);

        return $records
            ->map(function($record){
                $expected = intval($record['ExpectedPermanent'])== 0 ? null : $record['ExpectedPermanent'];
                $record['ratio'] = $expected!==null
                    ? min(1, ($record['ActualPermanent'] ?? 0) / ($expected))
                    : 1;
                $record['ratio03'] = $record['ratio']===0
                    ? 0
                    : ($record['ratio']>0
                        ? ceil($record['ratio'] * 4 -1)
                        : null);
                $record['w_avg'] = $expected!==null
                    ? 1 + log($expected)
                    : null;
                return $record;
            })
            ->keyBy('Function')
            ->map(function($record){
                return collect($record)->only(['Function', 'ActualPermanent', 'ExpectedPermanent', 'ratio', 'ratio03', 'w_avg']);
            })
            ->toArray();
    }


    protected static function score_i2($imet_id): ?float
    {
        $records = Staff::getModule($imet_id);
        $functions = $records->pluck('Theme')->toArray();

        $staff_weights = collect(static::staff_weights($imet_id))
            ->filter(function ($item) use($functions){
                return in_array($item['Function'], $functions);
            })
            ->map(function($item){
                $item['eval_sc'] = $item['ratio']>0
                    ? ceil($item['ratio'] * 4 - 1)
                    : 0;
                $item['weight'] =
                    (1 + log($item['ExpectedPermanent']==0 ? null : $item['ExpectedPermanent']));
                $item['eval_sc_by_weight'] = $item['ratio']>0
                    ? (1 + log($item['ExpectedPermanent']==0 ? null : $item['ExpectedPermanent']))
                        * ceil($item['ratio'] * 4 - 1)
                    : 0;
                return $item;
            });

        $numerator = $staff_weights->sum('eval_sc_by_weight');
        $denominator = $staff_weights->sum('weight');

        $score = $denominator>0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_i3($imet_id)
    {
        $records = BudgetAdequacy::getModule($imet_id)
            ->toArray();

        $value = !empty($records)
            ? (int) $records[0]['EvaluationScore']
            : null;

        if($value===1){
            $score = 17.5;
        } elseif($value===2){
            $score = 53;
        } elseif($value===3){
            $score = 85.5;
        } elseif($value===4){
            $score = 100;
        } else {
            $score = null;
        }
        return $score;
    }

    protected static function score_i4($imet_id)
    {
        $records = BudgetSecurization::getModule($imet_id)
            ->toArray();

        $value = !empty($records)
            ? (int) $records[0]['EvaluationScore']
            : null;

        if($value===1){
            $score = 16.7;
        } elseif($value===2){
            $score = 50;
        } elseif($value===3){
            $score = 83.3;
        } elseif($value===4){
            $score = 100;
        } else {
            $score = null;
        }
        return $score;
    }

    protected static function score_i5($imet_id): ?float
    {
        $imet_locale = Imet::find($imet_id)->language;
        $current_locale = App::getLocale();

        App::setLocale($imet_locale);
        $equipment_adequacy = ManagementEquipmentAdequacy::getModule($imet_id)
            ->map(function($record){
                $record['group_key'] = array_search(
                    $record['Equipment'],
                    trans('imet-core::v1_context.Equipments.groups')    // Locale temporary set to IMET's language
                );
                $record['Importance'] = floatval($record['Importance']);

                return $record;

            })
            ->pluck('Importance', 'group_key');
        App::setLocale($current_locale);

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

        $values = $equipment->map(function ($item, $index) use ($equipment_adequacy){
            $importance = $equipment_adequacy[$index] ?? null;
            $importance = null; // !!!!! TODO: to be removed (here only to compare with DB function - which is wrong)
            $imp_p1 = $importance + 1;
            $eq_imp = $imp_p1 * $item;

            return [
                'group_key' => $index,
                'AdequacyLevel' => $item,
                'Importance' => $importance,
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