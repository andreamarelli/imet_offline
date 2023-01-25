<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;


use AndreaMarelli\ImetCore\Controllers\__Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment;

use AndreaMarelli\ImetCore\Models\Imet\CrossAnalysis\CrossAnalysis;
use function view;

class EvalController extends __Controller
{
    use Assessment;

    /**
     * return if any discrepancies are found for cross analysis
     * and also the classes to be used for indication in the menu
     *
     * @param $form
     * @return array
     */
    protected function get_cross_analysis($form): array
    {
        $classes = [];
        $warnings = CrossAnalysis::getIndicators($form);
        if (count($warnings) > 0) {
            $classes['cross_analysis'] = 'cross-analysis-warnings';
        }

        return [$warnings, $classes];
    }

    /**
     * add extra step for cross analysis before the last one
     *
     * @param $form
     * @return array
     */
    protected function steps($form): array
    {
        $steps = array_keys($form->modules());
        $last_step = array_splice($steps, -1);
        return array_merge($steps, ['cross_analysis'], $last_step);
    }

    /**
     * Override edit route
     *
     * @param $item
     * @param null $step
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($item, $step = null)
    {
        $this->authorize('edit', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $step = $step == null ? 'context' : $step;

        $steps = $this->steps($form);

        list($warnings, $classes) = $this->get_cross_analysis($form);

        return view(static::$form_view_prefix . '.edit', [
            'item' => $form,
            'steps' => $steps,
            'step' => $step,
            'warnings' => $warnings,
            'classes' => $classes
        ]);
    }

}
