<?php

namespace AndreaMarelli\ModularForms\View\Module\Components\Buttons;

use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\View\Component;
use Illuminate\View\View;

class DeleteItem extends Component {

    public ?string $icon;
    public ?string $onClick;

    public function __construct() {
        $this->icon = Template::icon('trash', 'white');
        $this->onClick = 'deleteItem(index)';
    }

    /**
     * Get the view / contents that represent the component.\
     */
    public function render(): View
    {
        return view('modular-forms::module.components.buttons.delete_item');
    }

}
