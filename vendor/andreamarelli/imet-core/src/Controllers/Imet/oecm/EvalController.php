<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\oecm;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalController as BaseEvalController;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet_Eval;

class EvalController extends BaseEvalController
{
    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::oecm.evaluation';

}