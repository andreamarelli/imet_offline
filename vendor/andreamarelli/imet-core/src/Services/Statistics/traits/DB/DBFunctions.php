<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\DB;

use Illuminate\Support\Facades\DB;

trait DBFunctions
{
    private static function custom_db_function($imet_id, $function, $db_table, $addition_params = []): ?float
    {
        $params = '';
        if(!empty($addition_params)){
            foreach ($addition_params as $param){
                $params .= "'" . $param . "', ";
            }
        }
        $function = static::SCHEMA . ".". $function ."('NOT_USED', '" . $db_table . "', ". $params . "' ".$imet_id."')";
        $records = (array) DB::select(DB::raw('SELECT row_to_json(' . $function . ');'));
        $value =  $records === []
            ? null
            : json_decode($records[0]->row_to_json, true)['value_p'];
        return $value!==null
            ? round($value, 2)
            : null;

    }

    private static function table_db_function($imet_id, $db_table, $field, $function_variant = null): ?float
    {
        $function_name = $function_variant!==null ? $function_variant : 'get_imet_evaluation_stats_table_all';

        $function = static::SCHEMA . ".".$function_name."('NOT_USED', '" . $db_table . "', '".$field."',  '".$imet_id."')";
        $records = (array) DB::select(DB::raw('SELECT row_to_json(' . $function . ');'));
        return $records === []
            ? null
            : round(json_decode($records[0]->row_to_json, true)['value_p'], 2);
    }

    private static function group_db_function($imet_id, $db_table, $field, $group_field, $function_variant = null): ?float
    {
        $function_name = $function_variant!==null ? $function_variant : 'get_imet_evaluation_stats_group_all';

        $function = static::SCHEMA . ".".$function_name."('NOT_USED', '" . $db_table . "', '".$field."',  '".$group_field."',  '".$imet_id."')";
        $records = (array) DB::select(DB::raw('SELECT row_to_json(' . $function . ');'));
        return $records === []
            ? null
            : round(json_decode($records[0]->row_to_json, true)['value_p'], 2);
    }

    public static function rank_db_function($imet_id, $db_table, $field, $rank_group): ?float
    {
        $function = static::SCHEMA . ".get_imet_evaluation_stats_rank_all( '" . $db_table . "', '".$field."',  '".$rank_group."',  '".$imet_id."')";
        $records = (array) DB::select(DB::raw('SELECT row_to_json(' . $function . ');'));
        return $records === []
            ? null
            : round(json_decode($records[0]->row_to_json, true)['value_p'], 2);
    }

}
