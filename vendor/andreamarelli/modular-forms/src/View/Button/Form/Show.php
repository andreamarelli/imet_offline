<?php

namespace AndreaMarelli\ModularForms\View\Button\Form;

use AndreaMarelli\ModularForms\Enums\ModuleViewModes;
use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Show extends _Button
{
    public function __construct(string $controller, Model|string $item)
    {
        parent::__construct($controller, $item);
        $this->action = ModuleViewModes::SHOW;
        $this->text = Template::icon('eye');
        $this->tooltip = Str::ucfirst((trans('modular-forms::common.show')));
    }

}
