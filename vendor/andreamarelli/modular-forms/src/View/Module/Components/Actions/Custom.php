<?php

namespace AndreaMarelli\ModularForms\View\Module\Components\Actions;

use Illuminate\View\Component;
use Illuminate\View\View;

class Custom extends Component
{
    public function __construct(
        public array $definitions,
        public int $formId
    ) {}

    public function render(): View
    {
        return view('modular-forms::module.components.actions.custom');
    }

}
