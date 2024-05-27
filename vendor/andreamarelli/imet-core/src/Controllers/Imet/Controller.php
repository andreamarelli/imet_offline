<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\__Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Backup;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\ConvertSQLite;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\ImportExportJSON;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Merge;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Pame;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ModularForms\Helpers\HTTP;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\URL;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use function view;


abstract class Controller extends __Controller
{
    use Backup;
    use ConvertSQLite;
    use ImportExportJSON;
    use Merge;
    use Pame;

    public const ROUTE_PREFIX = 'imet-core::';

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::';

    protected const PAGINATE = false;

    public const sanitization_rules = [
        'search' => 'custom_text|nullable',
        'year' => 'digits:4|integer|nullable',
        'country' => 'min:3|max:3|alpha|nullable',
    ];

    /**
     * Override index route
     */
    public function index(Request $request): View
    {
        $this->authorize('viewAny', static::$form_class);
        HTTP::sanitize($request, self::sanitization_rules);

        // set filter status
        $filter_selected = !empty(array_filter($request->except('_token')));

        /** @var Imet $form_class */
        $form_class = static::$form_class;

        // retrieve IMET list
        $filtered_list = $form_class::get_assessments_list_with_extras($request);
        $full_list = $form_class::get_assessments_list(new Request(), ['country']);
        $years = $full_list->pluck('Year')->sort()->unique()->values()->toArray();
        $countries = $full_list->pluck('country.name', 'country.iso3')->sort()->unique()->toArray();

        return view(Controller::$form_view_prefix . 'list', [
            'controller' => static::class,
            'list' => $filtered_list,
            'request' => $request,
            'filter_selected' => $filter_selected,
            'countries' => $countries,
            'years' => $years,
            'index_url' => URL::route(static::ROUTE_PREFIX . 'index')
        ]);
    }

    /**
     * Manage "destroy" route
     *
     * @param $item
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy($item): RedirectResponse
    {
        if(static::AUTHORIZE_BY_POLICY) {
            $this->authorize('destroy', (static::$form_class)::find($item));
        }
        $form = new static::$form_class();
        $form = $form->find($item);
        $form->delete();
        return redirect()->route(static::ROUTE_PREFIX.'index');
    }

}
