<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ImetCore\Models\Imet\Components\BaseModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 *
 *
 * @package AndreaMarelli\ImetCore\Models
 */
class Region extends BaseModel
{
    protected string $schema = Database::COMMON_IMET_SCHEMA;
    protected $table = 'imet_regions';
    protected $keyType = 'string';

}
