<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\v1;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalController as BaseEvalController;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet_Eval;


class EvalController extends BaseEvalController
{
    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::v1.evaluation';

    /**
     * Override show route
     *
     * @param $item
     * @param null $step
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($item, $step = null)
    {
        $imet = (static::$form_class)::find($item);

        $this->authorize('view', $imet);

        $step = $step == null ? 'context' : $step;
        $steps = $this->steps($imet);
        $key = array_search('cross_analysis', $steps);
        unset($steps[$key]);

        return view(static::$form_view_prefix . '.show', [
            'item' => $imet,
            'steps' => $steps,
            'step' => $step
        ]);
    }

}
