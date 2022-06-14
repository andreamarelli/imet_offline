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

}
