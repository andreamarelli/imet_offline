<?php

namespace AndreaMarelli\ModularForms\View\Button\Form;

use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Database\Eloquent\Model;

class Generic extends _Button
{

    public function __construct(string $controller, Model|string $item, string $action, string $icon, string $tooltip = null)
    {
        parent::__construct($controller, $item);
        $this->action = $action;
        $this->text = Template::icon($icon, 'white');
        $this->tooltip = $tooltip;
    }

}
