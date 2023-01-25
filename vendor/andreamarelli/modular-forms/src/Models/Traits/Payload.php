<?php

namespace AndreaMarelli\ModularForms\Models\Traits;


class Payload{

    /**
     * Encode JSON object to Base64
     *
     * @param $object
     * @return string
     */
    public static function encode($object): string
    {
        return base64_encode(json_encode($object));
    }

    /**
     * Decode JSON object from Base64
     *
     * @param $encoded_object
     * @return array
     */
    public static function decode($encoded_object): array
    {
        return json_decode(base64_decode($encoded_object), true);
    }

}