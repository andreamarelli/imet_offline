<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use ReflectionException;
use function view;


abstract class ReportController extends Controller
{
    /**
     * Manage "report" edit route
     * @throws AuthorizationException
     */
    public function report(int $item): Factory|View
    {
        $imet = (static::$form_class)::find($item);

        $this->authorize('edit', $imet);

        return view(static::$form_view_prefix . '.edit', $this->__retrieve_report_data($imet));
    }

    /**
     * Manage "report" edit route
     * @throws AuthorizationException
     * @throws ReflectionException
     */
    public function report_show(int $item): Factory|View
    {
        $imet = (static::$form_class)::find($item);

        $this->authorize('view', $imet);

        return view(static::$form_view_prefix . '.show', $this->__retrieve_report_data($imet));
    }

    /**
     * Manage "report" update route
     * @throws AuthorizationException
     */
    public function report_update(int $item, Request $request): array
    {
        $this->authorize('edit', (static::$form_class)::find($item));

        \AndreaMarelli\ImetCore\Models\Imet\v1\Report::updateByForm($item, $request->input('report'));
        return ['status' => 'success'];
    }

}
