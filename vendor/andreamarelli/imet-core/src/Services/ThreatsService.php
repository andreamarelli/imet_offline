<?php

namespace AndreaMarelli\ImetCore\Services;

class ThreatsService{

    /**
     * Calculate threat's ranking
     *
     * @param $form_id
     * @param $records
     * @return array
     */
    public static function calculateRanking($records): array
    {
        return collect($records)
            ->map(function($item){

                $prod = 1
                    * ($item['Impact']!=null ? 4-$item['Impact'] : 1)
                    * ($item['Extension']!=null ? 4-$item['Extension'] : 1)
                    * ($item['Duration']!=null ? 4-$item['Duration'] : 1)
                    * ($item['Trend']!=null ? (5/2 - $item['Trend']*3/4) : 1)
                    * ($item['Probability']!=null ? 4-$item['Probability'] : 1);

                $count = ($item['Impact']!=null ? 1 : 0)
                    + ($item['Extension']!=null ? 1 : 0)
                    + ($item['Duration']!=null ? 1 : 0)
                    + ($item['Trend']!=null ? 1 : 0)
                    + ($item['Probability']!=null ? 1 : 0);

                $score = $count>0
                    ? (4 - round(pow($prod, 1/($count)),2))
                    : null;

                $score = $score!==null
                    ? (0 - $score) * 100 / 3
                    : null;

                $score = $score!==null
                    ? round($score, 1)
                    : null;

                $item['__score'] = $score;

                return $item;
            })
            ->sortBy('__score')
            ->toArray();
    }

}