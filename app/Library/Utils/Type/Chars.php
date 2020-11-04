<?php

namespace App\Library\Utils\Type;

class Chars
{

    /**
     * Check if a string (haystack) starts with the given substring (needle)
     *
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

    /**
     * Check if a string (haystack) ends with the given substring (needle)
     *
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function endsWith($haystack, $needle)
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

    /**
     * Check if a string (haystack) contains  the given substring (needle)
     *
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function contains($haystack, $needle)
    {
        return substr_count($haystack, $needle) > 0;
    }


    /**
     * Clean string: remove all characters except letters and digits (and other given chars)
     *
     * @param $string
     * @param $allow
     * @return mixed
     */
    public static function clean($string, $allow = '')
    {
        $regex = empty($allow) ?
            '/[^A-Za-z0-9]/' :
            '/[^A-Za-z0-9' . $allow . ']/';
        return preg_replace($regex, '', $string);
    }

    /**
     * Replace accented letters with the correspondant un-accented
     *
     * @param $string
     * @return string
     */
    public static function replaceAccents($string)
    {
        $normalizeChars = array(
            'Š' => 'S',
            'š' => 's',
            'Ð' => 'Dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ń' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ń' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'ƒ' => 'f',
            'ă' => 'a',
            'ș' => 's',
            'ț' => 't',
            'Ă' => 'A',
            'Ș' => 'S',
            'Ț' => 'T',
        );

        return strtr($string, $normalizeChars);
    }


    /**
     * Concert char code to utf8
     *
     * @param $char
     * @return string
     */
    public static function fromCharCode($char)
    {
        return mb_convert_encoding($char, 'UTF-8', 'HTML-ENTITIES');
    }

    /**
     * Concert char code string to utf8
     *
     * @param $string
     * @return string
     */
    public static function decodeCharCodeString($string)
    {
        $decoded = '';
        preg_match_all("/(&#\d+;)/", $string, $matches);
        foreach ($matches[1] as $char) {
            $decoded .= static::fromCharCode($char);
        }
        return $decoded;
    }

}