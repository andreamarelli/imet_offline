<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\__Controller;
use AndreaMarelli\ImetCore\Models\Imet\CrossAnalysis\CrossAnalysis;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet_Eval;

use function view;


class CrossAnalysisController extends __Controller
{
    public const AUTHORIZE_BY_POLICY = true;

    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::v2.cross_analysis';

    /**
     * show cross analysis view
     * @param $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function cross_analysis($item)
    {
        $this->authorize('view', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $warnings = CrossAnalysis::getIndicators($form);
        return view(static::$form_view_prefix.'.index',
            [
                'item' => $form,
                'warnings' => $warnings
            ]
        );
    }

}
