<?php

namespace AndreaMarelli\ModularForms\View\Button\Action;

use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Support\Str;

class Csv extends _Button
{
    public function __construct(
        public String $controller,
        ?string $text = null,
        bool $newPage = false,
        ?string $tooltip = null
    ) {
        parent::__construct($controller, $text, $newPage, $tooltip);

        $this->action = 'csv';
        $this->text = $text
            ? Template::icon('file-alt', 'white') . ' ' . $text
            : Template::icon('file-alt', 'white') . ' '. Str::ucfirst(trans('modular-forms::common.csv'));
        $this->tooltip = $tooltip ?? Str::ucfirst((trans('modular-forms::common.csv')));
    }

}
