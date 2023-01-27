<?php

namespace AndreaMarelli\ModularForms\Helpers\Type;

use Illuminate\Support\Str;

class Chars
{

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
     * Replace accented letters with the correspondent un-accented
     *
     * @param $string
     * @return string
     */
    public static function replaceAccents($string): string
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
     * Convert char code to utf8
     *
     * @param $char
     * @return string
     */
    public static function fromCharCode($char): string
    {
        return mb_convert_encoding($char, 'UTF-8', 'HTML-ENTITIES');
    }

    /**
     * Convert char code string to utf8
     *
     * @param $string
     * @return string
     */
    public static function decodeCharCodeString($string): string
    {
        $decoded = '';
        preg_match_all("/(&#\d+;)/", $string, $matches);
        foreach ($matches[1] as $char) {
            $decoded .= static::fromCharCode($char);
        }
        return $decoded;
    }

    /**
     * Check whenever $haystack contains $needle (CASE and ACCENT insensitive)
     *
     * @param $haystack
     * @param $needle
     * @return boolean
     */
    public static function case_and_accent_insensitive_contains($haystack, $needle): bool {
        return Str::contains(
            Str::lower(Chars::replaceAccents($haystack)),
            Str::lower(Chars::replaceAccents($needle))
        );
    }

}
