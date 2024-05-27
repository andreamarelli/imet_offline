<?php

namespace AndreaMarelli\ImetCore\Models\Imet\Components;

use AndreaMarelli\ImetCore\Helpers\Database;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected string $schema;
    // $table & $connection already defined in Illuminate\Database\Eloquent\Model

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        [$this->schema, $this->connection] = Database::getSchemaAndConnection($this->schema);
    }
}