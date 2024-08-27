<?php

namespace AndreaMarelli\ModularForms\View\Button\Action;

use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Support\Str;

class Create extends _Button
{
    public function __construct(
        public String $controller,
        ?string $text = null,
        bool $newPage = false,
        ?string $tooltip = null
    ) {
        parent::__construct($controller, $text, $newPage, $tooltip);

        $this->action = 'create';
        $this->text = $text
            ? Template::icon('plus-circle', 'white') . ' ' . $text
            : Template::icon('plus-circle', 'white') . ' '. Str::ucfirst(trans('modular-forms::common.create'));
        $this->tooltip = $tooltip ?? Str::ucfirst((trans('modular-forms::common.create')));
    }

}
