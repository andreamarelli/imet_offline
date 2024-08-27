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
     */
    public static function sendAPIResponse($data, Request $request = null, int $code = 200, array $additional_data = null): JsonResponse
    {
        $body = [
            'status' => $code,
            'request_params' => $request?->all(),
            'records' => $data
        ];

        if($additional_data!==null){
            $body = array_merge($body, $additional_data);
        }

        $response = response()->json($body);
        $response->header('Content-Type', 'application/json');
        $response->header('charset', 'utf-8');
        return $response;
    }

    /**
     * Send an error on API
     */
    public static function sendAPIError($error_code, $message = null): void
    {
        abort($error_code, $message);
    }

}
