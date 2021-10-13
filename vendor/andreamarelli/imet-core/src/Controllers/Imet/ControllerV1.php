<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportControllerV1;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;


class ControllerV1 extends Controller
{
    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v1.context';
    protected static $form_default_step = 'general_info';

    public const AUTHORIZE_BY_POLICY = true;

}
