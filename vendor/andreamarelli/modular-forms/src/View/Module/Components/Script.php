<?php

namespace AndreaMarelli\ModularForms\View\Module\Components;

use AndreaMarelli\ModularForms\Enums\ModuleViewModes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Script extends Component{

    public function __construct(
        public Collection $collection,
        public array $vueData,
        public array $definitions,
        public array $records,
        public ?int $formId,
        public string $mode
    ){}

    public function render(): View
    {
        if($this->mode === ModuleViewModes::EDIT){
            return view('modular-forms::module.edit.script');
        } else{
            return view('modular-forms::module.show.script');
        }

    }

}
