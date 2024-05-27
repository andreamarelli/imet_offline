<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component;

use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ImetCore\Models\Imet\Components\Modules\ImetModule as BaseImetModule;
use AndreaMarelli\ImetCore\Models\Imet\Components\Upgrade;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;


class ImetModule extends BaseImetModule
{
    use Upgrade;

    protected string $schema = Database::IMET_SCHEMA;

    protected static $form_class = Imet::class;
}
