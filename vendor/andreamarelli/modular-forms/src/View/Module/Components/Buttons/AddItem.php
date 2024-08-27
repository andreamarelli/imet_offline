<?php

namespace AndreaMarelli\ModularForms\View\Module\Components\Buttons;

use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\View\Component;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AddItem extends Component {

    public ?string $text;
    public ?string $icon;
    public ?string $onClick;

    public function __construct(
        public ?string $groupKey
    ) {
        $this->text = Str::ucfirst((trans('modular-forms::common.add_item')));
        $this->icon = Template::icon('plus-circle', 'white');
        $this->onClick = $groupKey!==null && $groupKey!==''
            ? 'addItem(\''.$groupKey.'\')'
            : 'addItem';
    }

    /**
     * Get the view / contents that represent the component.\
     */
    public function render(): View
    {
        return view('modular-forms::module.components.buttons.add_item');
    }

}
