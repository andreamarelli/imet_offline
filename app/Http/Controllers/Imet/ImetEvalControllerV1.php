<?php

namespace App\Http\Controllers\Imet;

use App\Models\Imet\v1\Imet_Eval;


class ImetEvalControllerV1 extends ImetEvalController
{

    protected static $form_class = Imet_Eval::class;
    protected static $form_view = 'imet/v1';

}