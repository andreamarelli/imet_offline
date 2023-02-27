<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\__Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class EvalController extends __Controller
{
    /**
     * Override edit route
     *
     * @param $item
     * @param null $step
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit($item, $step = null)
    {
        $imet = (static::$form_class)::find($item);
        $this->authorize('view', $imet);

        $step = $step == null ? 'context' : $step;

        return view(static::$form_view_prefix . '.edit', [
            'item' => $imet,
            'step' => $step
        ]);
    }

    /**
     * Override show route
     *
     * @param $item
     * @param null $step
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show($item, $step = null)
    {
        $imet = (static::$form_class)::find($item);
        $this->authorize('view', $imet);

        $step = $step == null ? 'context' : $step;

        return view(static::$form_view_prefix . '.show', [
            'item' => $imet,
            'step' => $step
        ]);
    }
}
