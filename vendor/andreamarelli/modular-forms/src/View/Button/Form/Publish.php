<?php

namespace AndreaMarelli\ModularForms\View\Button\Form;

use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publish extends _Button
{

    public function __construct(string $controller, Model|string $item)
    {
        parent::__construct($controller, $item);
        $this->action = 'publish';
        $this->text = Template::icon('eye', 'white');
        $this->tooltip = Str::ucfirst((trans('modular-forms::common.show')));
    }

}
