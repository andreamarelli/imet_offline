<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits;

trait Math
{
    protected static function average($data, $precision = 2): ?float
    {
        $sum = 0;
        $count_not_null = 0;
        foreach($data as $item){
            $sum += $item ?? 0;
            if($item !== null){
                $count_not_null++;
            }
        }
        $average = $count_not_null > 0
            ? $sum / $count_not_null
            : null;

        return $average!==null && $precision!==null
            ? round($average, $precision)
            : $average;
    }


}