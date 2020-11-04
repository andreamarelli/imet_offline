<?php

namespace App\Library\Utils;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Validator;

class HTTP
{

    /**
     * Validate Request parameters
     *
     * @param Request $request
     * @param array $rules
     * @return bool
     */
    public static function sanitize(Request $request, $rules = [])
    {
        if (!empty($rules)) {
            $sanitizator = Validator::make($request->all(), $rules);
            if ($sanitizator->fails()) {
                throw new BadRequestHttpException($sanitizator->messages());
            }
        }
        return true;
    }

    /**
     * Wrap file_get_contents for using behind a reverse proxy
     *
     * @param $url
     * @return false|string
     */
    public static function get_contents($url)
    {
        $context = [];
        if (isset($_SERVER['HTTPS_PROXY'])) {
            $context = [
                'http' => [
                    'proxy' => 'tcp://' . str_replace('http://', '', $_SERVER['HTTPS_PROXY']),
                    'request_fulluri' => true,
                ]
            ];
        }

        return file_get_contents($url, false, stream_context_create($context));
    }

}