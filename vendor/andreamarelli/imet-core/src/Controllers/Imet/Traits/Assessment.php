<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use function response;

trait Assessment
{

    public static function assessment($item, string $step = 'global', bool $labels= false): JsonResponse
    {
        $stats = Imet::getVersion($item)===Imet::IMET_V1
            ? V1ToV2StatisticsService::get_assessment($item, $step)
            : V2StatisticsService::get_assessment($item, $step);

        return response()->json($stats);
    }


    public static function score_class($value, $additional_classes=''): string
    {
        if($value===null){
            $class = 'score_no';
        } elseif($value===0){
            $class = 'score_danger';
        } elseif($value<34){
            $class = 'score_alert';
        } elseif($value<51){
            $class = 'score_warning';
        } else {
            $class = 'score_success';
        }
        return 'class="'.$class.' '.$additional_classes.'"';
    }

    public static function score_class_threats($value, $additional_classes=''): string
    {
        if($value===null){
            $class = 'score_no';
        } elseif($value<-51){
            $class = 'score_danger';
        } elseif($value<-34){
            $class = 'score_alert';
        } elseif($value<-1){
            $class = 'score_warning';
        } else {
            $class = 'score_success';
        }
        return 'class="'.$class.' '.$additional_classes.'"';
    }

}

