<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use Illuminate\Http\Request;

use function view;


class ReportController extends Controller
{
    /**
     * Manage "report" edit route
     *
     * @param $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException|\ReflectionException
     */
    public function report($item)
    {
        $imet = (static::$form_class)::find($item);

        $this->authorize('edit', $imet);

        return view(static::$form_view_prefix . '.edit', $this->__retrieve_report_data($imet));
    }

    /**
     * Manage "report" edit route
     *
     * @param $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ReflectionException
     */
    public function report_show($item)
    {
        $imet = (static::$form_class)::find($item);

        $this->authorize('view', $imet);

        return view(static::$form_view_prefix . '.show', $this->__retrieve_report_data($imet));
    }

    /**
     * Manage "report" update route
     *
     * @param $item
     * @param \Illuminate\Http\Request $request
     * @return string[]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function report_update($item, Request $request): array
    {
        $this->authorize('edit', (static::$form_class)::find($item));

        \AndreaMarelli\ImetCore\Models\Imet\v1\Report::updateByForm($item, $request->input('report'));
        return [ 'status' => 'success' ];
    }

}