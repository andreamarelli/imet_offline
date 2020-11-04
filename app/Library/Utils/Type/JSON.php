<?php

namespace App\Library\Utils\Type;

class JSON{

    public static function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function toVue($data){
        $data_json = json_encode($data);
        $data_json = addslashes($data_json);
        return $data_json;
    }

}