<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Component;


use AndreaMarelli\ImetCore\Models\Imet\Components\Modules\ImetModule_Eval as BaseImetEvalModule;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;

class ImetModule_Eval extends BaseImetEvalModule
{
    protected static $form_class = Imet::class;
}