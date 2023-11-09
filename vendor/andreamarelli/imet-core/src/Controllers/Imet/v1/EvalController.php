<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\v1;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalController as BaseEvalController;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet_Eval;


class EvalController extends BaseEvalController
{
    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::v1.evaluation';

}
