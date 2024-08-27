<?php

namespace AndreaMarelli\ModularForms\View\Button\Action;

use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Support\Str;

class Generic extends _Button
{
    public function __construct(
        public String $controller,
        public String $action,
        ?string $text = null,
        ?string $icon = null,
        bool $newPage = false,
        ?string $tooltip = null
    ) {
        parent::__construct($controller, $text, $newPage, $tooltip);

        $this->action = $action;
        $this->icon = $icon!==null
            ? Template::icon($icon). ' '
            : '';
        $this->text = $this->icon . Str::ucfirst($text);
        $this->tooltip = $tooltip ?? '';
    }

}
