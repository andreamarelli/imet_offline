<?php

namespace AndreaMarelli\ModularForms\View\Button\Action;

use Closure;
use Illuminate\View\Component;

abstract class _Button extends Component
{
    protected string $action;
    public string $text;
    public string $tooltip;
    public bool $newPage = false;
    public string $role = 'button';

    public function __construct(
        public String $controller,
        ?string $text = null,
        bool $newPage = false,
        ?string $tooltip = null
    ) {
        $this->controller = $controller;
    }

    public function href(): string
    {
        return 'href=' . action([$this->controller, $this->action]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Closure
    {
        return function (array $data)
        {
            $merged_attributes = $data['attributes']->merge(['class' => 'rounded']);
            $this->attributes->setAttributes([
                'class' => $merged_attributes['class']
            ]);
            return view('modular-forms::components.button.generic');
        };
    }

}
