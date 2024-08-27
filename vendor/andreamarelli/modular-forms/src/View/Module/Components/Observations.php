<?php

namespace AndreaMarelli\ModularForms\View\Module\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Observations extends Component
{
    public bool $has_observations;
    public array $observation_fields;
    public const FIELD_NAMES = ['observations'];

    public function __construct(public array $definitions)
    {
        // Retrieve the "Observation" field (if exists)
        $this->has_observations = false;
        $this->observation_fields = [];
        if($this->definitions['module_type']==='TABLE' || $this->definitions['module_type']==='ACCORDION'){
            $this->check_fields($definitions['common_fields']);
        } else {
            $this->check_fields($definitions['fields']);
        }
    }

    private function check_fields($fields): void
    {
        foreach($fields as $field){
            if(in_array($field['name'], static::FIELD_NAMES)){
                $this->has_observations = true;
                $this->observation_fields[] = $field;
            }
        }
    }

    public function render(): View
    {
        return view('modular-forms::module.components.actions.observations');
    }

}
