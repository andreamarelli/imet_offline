<?php

namespace AndreaMarelli\ImetCore\Services\Scores\Functions\CustomFunctions\oecm;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElementsImpact;

trait Outcomes
{

    protected static function score_oc2(int $imet_id): ?float
    {
        return KeyElementsImpact::getModule($imet_id)
            ->filter(function($item){
                return ($item['EffectSH']!==null && $item['ReliabilitySH']!==null)
                    || ($item['EffectER']!==null && $item['ReliabilityER']!==null);
            })
            ->map(function ($item){

                if($item['ReliabilitySH']===null){
                    $reliabilitySH = 0;
                } else if($item['ReliabilitySH']==='high'){
                    $reliabilitySH = 3;
                } else if($item['ReliabilitySH']==='medium'){
                    $reliabilitySH = 2;
                } else {
                    $reliabilitySH = 1;
                }

                if($item['ReliabilityER']===null){
                    $reliabilityER = 0;
                } else if($item['ReliabilityER']==='high'){
                    $reliabilityER = 3;
                } else if($item['ReliabilityER']==='medium'){
                    $reliabilityER = 2;
                } else {
                    $reliabilityER = 1;
                }

                $item['_score'] =  (($item['EffectSH'] * $reliabilitySH) + ($item['EffectER'] * $reliabilityER))
                    / ($reliabilitySH + $reliabilityER);

                return $item;
            })
            ->pluck(['_score'])
            ->avg();

    }
}
