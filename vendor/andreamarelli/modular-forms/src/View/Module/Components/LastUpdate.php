<?php

namespace AndreaMarelli\ModularForms\View\Module\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class LastUpdate extends Component
{
    public function __construct(
        public string $mode,
        public ?array $last_update
    ) {}

    public function render(): View
    {
        return view('modular-forms::module.components.last_update');
    }

}
