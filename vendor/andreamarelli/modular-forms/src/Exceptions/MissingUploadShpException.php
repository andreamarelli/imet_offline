<?php

namespace AndreaMarelli\ModularForms\Exceptions;

use Exception;

class MissingUploadShpException extends Exception
{
    protected $message = '.shp file not found in ZIP archive';
}
