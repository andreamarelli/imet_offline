<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1;

use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ImetCore\Models\Imet\Components\Encoder as BaseEncoder;

class Encoder extends BaseEncoder
{
    protected string $schema = Database::IMET_SCHEMA;
    protected $table = 'imet_encoders';
}
