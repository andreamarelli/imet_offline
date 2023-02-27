<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\v2;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller as BaseController;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\CreateAndStoreNonWdpa;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Prefill;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;

class Controller extends BaseController
{
    use Prefill;
    use CreateAndStoreNonWdpa;

    public const ROUTE_PREFIX = 'imet-core::v2.';

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v2';

}
