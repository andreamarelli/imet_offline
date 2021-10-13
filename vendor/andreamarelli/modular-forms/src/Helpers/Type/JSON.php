<?php

namespace AndreaMarelli\ModularForms\Helpers\Type;

class JSON{

    /**
     * Check if the given string is a valid JSON
     *
     * @param $string
     * @return bool
     */
    public static function isJson($string): bool
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

}
