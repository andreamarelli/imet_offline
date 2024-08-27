<?php

namespace AndreaMarelli\ModularForms\View\Module\Components\Actions;

use Illuminate\View\Component;
use Illuminate\View\View;

class NoData extends Component{

    public function render(): View
    {
        return view('modular-forms::module.components.actions.no_data');
    }

}
