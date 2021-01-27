<?php

namespace App\Http\Controllers\Imet;

use App\Http\Controllers\Components\FormController;
use App\Models\Imet\v1\Imet;


class ImetControllerV1 extends FormController
{
    use ReportV1;

    protected static $form_class = Imet::class;
    protected static $form_view = 'imet/v1/context';
    protected static $form_default_step = 'general_info';

    public const AUTHORIZE_BY_POLICY = true;

}
