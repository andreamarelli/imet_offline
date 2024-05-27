<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Component;


use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ImetCore\Models\Imet\Components\Modules\ImetModule as BaseImetModule;
use AndreaMarelli\ImetCore\Models\Imet\Components\Upgrade;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;


class ImetModule extends BaseImetModule
{
    use Upgrade;

    public const MODULE_SCOPE = null;

    protected string $schema = Database::OECM_SCHEMA;

    protected static $form_class = Imet::class;

}
