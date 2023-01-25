<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits;

trait CommonFunctions {

    /**
     * Standard function for TABLE type modules
     *
     * @param $imet_id
     * @param $module_class
     * @param $module_field
     * @param int $denominator
     * @return float|null
     */
    private static function score_table($imet_id, $module_class, $module_field, int $denominator = 3): ?float
    {
        $records = $module_class::getModule($imet_id);
        $values = $records
            ->pluck($module_field)
            ->filter(function ($value) {
                return $value != -99;
            })
            ->toArray();

        $average = static::average($values, null);
        $score = $average!==null ? $average / $denominator * 100 : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    /**
     * Standard function for GROUP type modules
     *
     * @param $imet_id
     * @param $module_class
     * @param $module_field
     * @param $group_field
     * @return float|null
     */
    private static function score_group($imet_id, $module_class, $module_field, $group_field): ?float
    {
        $records = $module_class::getModule($imet_id);
        $values = $records
            ->groupBy($group_field)
            ->map(function($group) use($module_field) {
                $group_values = $group
                    ->filter(function ($value) use($module_field) {
                        return $value[$module_field] != -99;
                    })
                    ->pluck($module_field)
                    ->toArray();
                return !empty($group_values)
                    ? static::average($group_values, null)
                    : null;
            })
            ->filter(function ($value) {
                return $value != -99;
            })
            ->toArray();

        $average = static::average($values, null);
        $score = $average!==null ? $average / 3 * 100 : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }


}