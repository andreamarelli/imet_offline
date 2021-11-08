<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;


use AndreaMarelli\ImetCore\Controllers\__Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\Assessment;

use function view;

class EvalController extends __Controller
{
    use Assessment;

    public const AUTHORIZE_BY_POLICY = true;

    /**
     * Override edit route
     *
     * @param $item
     * @param null $step
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($item, $step=null)
    {
        $this->authorize('update', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $step = $step==null ? 'context' : $step;
        return view(static::$form_view_prefix . '.edit', [
            'item' => $form,
            'step' => $step
        ]);
    }

}
