<?php

namespace App\Http\Controllers\Imet;

use App\Models\Imet\v2\Imet_Eval;


class ImetEvalControllerV2 extends ImetEvalController
{

    protected static $form_class = Imet_Eval::class;
    protected static $form_view = 'imet/v2';

    /**
     * Override show route
     *
     * @param $item
     * @param null $step
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($item, $step=null)
    {
        $this->authorize('view', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $step = $step==null ? 'context' : $step;
        return view('admin.'.static::$form_view.'.evaluation.show', [
            'item' => $form,
            'step' => $step
        ]);
    }

}