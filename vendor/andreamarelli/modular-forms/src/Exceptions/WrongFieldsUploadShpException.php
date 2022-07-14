<?php

namespace AndreaMarelli\ModularForms\Exceptions;

use Exception;

class WrongFieldsUploadShpException extends Exception
{
    protected $message = '.shp fields does not correspond';
}
