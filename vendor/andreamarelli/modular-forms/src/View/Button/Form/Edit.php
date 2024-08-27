<?php

namespace AndreaMarelli\ModularForms\View\Button\Form;

use AndreaMarelli\ModularForms\Enums\ModuleViewModes;
use AndreaMarelli\ModularForms\Helpers\Template;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Edit extends _Button
{
    public ?string $additional_class = 'yellow';

    public function __construct(string $controller, Model|string $item)
    {
        parent::__construct($controller, $item);
        $this->action = ModuleViewModes::EDIT;
        $this->text = Template::icon('pen', 'white');
        $this->tooltip = Str::ucfirst((trans('modular-forms::common.edit')));
    }

}
