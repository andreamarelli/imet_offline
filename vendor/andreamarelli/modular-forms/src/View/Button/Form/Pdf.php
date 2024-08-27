<?php

namespace AndreaMarelli\ModularForms\View\Button\Form;

use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pdf extends _Button
{

    public function __construct(string $controller, Model|string $item)
    {
        parent::__construct($controller, $item);
        $this->action = 'pdf';
        $this->text = Template::icon('file-pdf', 'white');
        $this->tooltip = Str::ucfirst((trans('modular-forms::common.pdf')));
    }

}
