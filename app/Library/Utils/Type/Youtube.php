<?php

namespace App\Library\Utils\Type;

class Youtube
{

    public static function getVideoId($url)
    {
        $re = '/https:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z\d]*)&/m';
        preg_match($re, $url, $matches);
        return $matches[1] ?? null;
    }

    public static function getThumbnailUrl($url)
    {
        $id = self::getVideoId($url);
        return $id !== null ? 'https://img.youtube.com/vi/' . $id . '/default.jpg' : null;
    }

}
