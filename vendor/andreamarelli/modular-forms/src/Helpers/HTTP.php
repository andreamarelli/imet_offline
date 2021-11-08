<?php

namespace AndreaMarelli\ModularForms\Helpers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Support\Facades\Validator;

class HTTP
{

    /**
     * Validate Request parameters
     *
     * @param Request $request
     * @param array $rules
     * @return bool
     */
    public static function sanitize(Request $request, $rules = []): bool
    {
        if (!empty($rules)) {
            $sanitizer = Validator::make($request->all(), $rules);
            if ($sanitizer->fails()) {
                throw new BadRequestHttpException($sanitizer->messages());
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
