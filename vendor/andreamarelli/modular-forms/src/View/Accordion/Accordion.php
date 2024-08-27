<?php

namespace AndreaMarelli\ModularForms\View\Accordion;

use Illuminate\View\Component;
use Illuminate\View\View;

class Accordion extends Component
{
    /**
     * Create the component instance.
     */
    public function __construct(
        public String|null $id = null,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('modular-forms::components.accordion.container');
    }
}
