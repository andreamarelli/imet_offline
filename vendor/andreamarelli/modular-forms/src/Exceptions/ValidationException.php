<?php

namespace AndreaMarelli\ModularForms\Exceptions;

use Exception;
use Throwable;


class ValidationException extends Exception
{

    private $validation_errors = [];

    public function __construct(array $validation_errors, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->validation_errors = $validation_errors;
        $message = trans('modular-forms::common.validation_error');
        parent::__construct($message, $code, $previous);
    }

    public function getValidationErrors(): array
    {
        return $this->validation_errors;
    }

}
