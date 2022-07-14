<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Models\Imet\v2\Imet_Eval;

use function view;


class EvalControllerV2 extends EvalController
{

    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::v2.evaluation';

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
        $this->authorize('view', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $step = $step == null ? 'context' : $step;

        $steps = $this->steps($form);

        list($warnings, $classes) = $this->get_cross_analysis($form);

        return view(static::$form_view_prefix . '.show', [
            'item' => $form,
            'steps' => $steps,
            'step' => $step,
            'warnings' => $warnings,
            'classes' => $classes
        ]);
    }

}
