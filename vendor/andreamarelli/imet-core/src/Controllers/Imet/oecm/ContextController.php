<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\oecm;


class ContextController extends Controller
{
    protected static $form_view_prefix = 'imet-core::oecm.context';
    protected static $form_default_step = 'general_info';

    public function print_sa($item)
    {
        if(static::AUTHORIZE_BY_POLICY){
            $this->authorize('view', (static::$form_class)::find($item));
        }
        $form = new static::$form_class();
        $form = $form->find($item);
        return view(static::$form_view_prefix.'.print_sa', [
            'item' => $form
        ]);
    }

}