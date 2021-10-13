<?php

namespace AndreaMarelli\ModularForms\Helpers\Type;

class Youtube
{

    /**
     * Extract the video ID from the given URL
     *
     * @param $url
     * @return mixed|null
     */
    public static function getVideoId($url)
    {
        $re = '/https:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z\d]*)&/m';
        preg_match($re, $url, $matches);
        return $matches[1] ?? null;
    }

    /**
     * Retrieve the URL of the video thumbnail
     *
     * @param $url
     * @return string|null
     */
    public static function getThumbnailUrl($url): ?string
    {
        $id = self::getVideoId($url);
        return $id !== null ? 'https://img.youtube.com/vi/' . $id . '/default.jpg' : null;
    }

}
