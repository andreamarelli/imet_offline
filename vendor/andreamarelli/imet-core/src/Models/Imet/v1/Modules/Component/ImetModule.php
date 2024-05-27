<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Component;

use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ImetCore\Models\Imet\Components\Modules\ImetModule as BaseImetModule;
use AndreaMarelli\ImetCore\Models\Imet\Components\Upgrade;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;


class ImetModule extends BaseImetModule
{
    use Upgrade;
    use ConvertSQLite;

    protected string $schema = Database::IMET_SCHEMA;

    protected static $form_class = Imet::class;
}
