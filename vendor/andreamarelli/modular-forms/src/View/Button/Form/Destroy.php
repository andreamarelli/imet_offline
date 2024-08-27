<?php

namespace AndreaMarelli\ModularForms\View\Button\Form;

use AndreaMarelli\ModularForms\Helpers\Template;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class Destroy extends Component
{
    private string $action = 'destroy';
    
    public function __construct(
        public String $controller,
        public Model|String $item
    ) {}

    public function form_action(): string
    {
        if($this->item instanceof Model){
            return action([$this->controller, $this->action], [$this->item->getKey()]);
        }  else if(is_int($this->item)){
            return action([$this->controller, $this->action], [$this->item]);
        } else {
            return vueAction($this->controller, $this->action, $this->item ?? 'item.id');
        }
    }

    public function render(): View
    {
        return view('modular-forms::components.button.destroy');
    }

}
