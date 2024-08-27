<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\View\View;
use function redirect;


trait Merge
{
    /**
     * Open the merge tool view
     *
     * @param $item
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function merge_view($item)
    {
        $form = (static::$form_class)::find($item);
        $this->authorize('edit', $form);

        return view(Controller::$form_view_prefix . '.merge.list', [
            'controller' => static::class,
            'primary_form' => $form,
            'duplicated_forms' => $form->getDuplicates()
        ]);
    }

    /**
     * Execute the merge of the given module
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function merge(Request $request): RedirectResponse
    {
        $module_class = $request->input('module');
        $source_form_id = $request->input('source_form');
        $destination_form_id = $request->input('destination_form');

        $records = $module_class::exportModule($source_form_id);
        $records = array_map(function ($item) use ($module_class, $destination_form_id) {
            $item[(new $module_class())->getKeyName()] = null;
            $item[$module_class::$foreign_key] = $destination_form_id;
            return $item;
        }, $records);

        $request = new Request();
        $request->merge(['records_json' => Payload::encode($records)]);
        $request->merge(['form_id' => $destination_form_id]);

        $module_class::updateModule($request);

        return redirect()->route($this::ROUTE_PREFIX.'merge_view', ['item' => $destination_form_id]);
    }
}