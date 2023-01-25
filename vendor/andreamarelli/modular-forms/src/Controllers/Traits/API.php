<?php

namespace AndreaMarelli\ModularForms\Controllers\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Trait API
 *
 * @package AndreaMarelli\ModularForms\Controllers\Traits
 */
trait API {

    /**
     * Send a successful JSON API response
     *
     * @param $data
     * @param Request|null $request
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendAPIResponse($data, Request $request = null, int $code = 200): JsonResponse
    {
        $body = [
            'status' => $code,
            'request_params' => $request ? $request->all() : null,
            'records' => $data
        ];

        $response = response()->json($body);
        $response->header('Content-Type', 'application/json');
        $response->header('charset', 'utf-8');
        return $response;
    }

    /**
     * Send an error on API
     *
     * @param $error_code
     * @param array $message
     */
    public static function sendAPIError($error_code, $message = null)
    {
        abort($error_code, $message);
    }

}
