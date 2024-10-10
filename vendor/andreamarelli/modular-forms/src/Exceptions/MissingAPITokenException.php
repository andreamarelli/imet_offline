<?php

namespace AndreaMarelli\ModularForms\Exceptions;

use Exception;
use Throwable;


class MissingAPITokenException extends Exception
{

    public function __construct($api_name, $code = 0, Throwable $previous = null)
    {
        $message = trans('Missing API token: ' . $api_name);
        parent::__construct($message, $code, $previous);
    }

}
