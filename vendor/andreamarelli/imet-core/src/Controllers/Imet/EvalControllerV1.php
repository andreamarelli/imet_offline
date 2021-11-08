<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet_Eval;


class EvalControllerV1 extends EvalController
{

    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::v1.evaluation';

}
