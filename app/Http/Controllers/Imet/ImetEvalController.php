<?php

namespace App\Http\Controllers\Imet;

use App\Http\Controllers\Components\FormController;


class ImetEvalController extends FormController
{
    use Assessment;

    public const AUTHORIZE_BY_POLICY = true;

    /**
     * Override edit route
     *
     * @param $item
     * @param null $step
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($item, $step=null)
    {
        $this->authorize('update', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $step = $step==null ? 'context' : $step;
        return view('admin.'.static::$form_view.'.evaluation.edit', [
            'item' => $form,
            'step' => $step
        ]);
    }

}