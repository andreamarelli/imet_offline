<?php

namespace AndreaMarelli\ImetCore\Exceptions;

use Exception;
use Throwable;


class MissingDependencyConfigurationException extends Exception
{

    public function __construct($class_name, $code = 0, Throwable $previous = null)
    {
        $message = trans('Missing dependency configuration on ' . $class_name);
        parent::__construct($message, $code, $previous);
    }

}
