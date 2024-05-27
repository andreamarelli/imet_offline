<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2;

use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ImetCore\Models\Imet\Components\Report as BaseReport;
class Report extends BaseReport
{
    protected string $schema = Database::IMET_SCHEMA;
    protected $table = 'imet_report';
}
