<?php

namespace AndreaMarelli\ModularForms\Helpers\File;

trait Hash
{

    /**
     * Generate an hash to be used to identify an entity (from controller info)
     *
     * @param $params
     * @return string
     */
    public static function encodeHash($params): string
    {
        return str_replace('=', '', base64_encode(json_encode($params)));
    }

    /**
     * Decode the hash to retrieve an entity
     *
     * @param $hash
     * @return mixed
     */
    public static function decodeHash($hash)
    {
        // adding removed padding "="
        $div = strlen($hash) % 4;
        if ($div == 2) {
            $hash .= '==';
        } elseif ($div == 3) {
            $hash .= '=';
        }

        return json_decode(base64_decode($hash), true);
    }

}