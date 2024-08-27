<?php

namespace AndreaMarelli\ModularForms\View\Button\Action;

use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Support\Str;

class Xls extends _Button
{
    public function __construct(
        public String $controller,
        ?string $text = null,
        bool $newPage = false,
        ?string $tooltip = null
    ) {
        parent::__construct($controller, $text, $newPage, $tooltip);

        $this->action = 'xls';
        $this->text = $text
            ? Template::icon('file-excel', 'white') . ' ' . $text
            : Template::icon('file-excel', 'white') . ' '. Str::ucfirst(trans('modular-forms::common.xls'));
        $this->tooltip = $tooltip ?? Str::ucfirst((trans('modular-forms::common.xls')));
    }

}
