<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use App\Library\Utils\File\File;
use Illuminate\Http\Request;
use App\Library\Utils\HTTP;

class FormController extends Controller
{

    protected static $form_class = null;
    protected static $form_view = null;
    protected static $form_default_step = null;

    protected const PAGINATE = true;
    protected const PER_PAGE = 50;
    protected const AUTHORIZE_BY_POLICY = false;

    public const sanitization_rules = [];

    public function __construct()
    {

    }

    /**
     * Manage "index" route
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        if(static::AUTHORIZE_BY_POLICY){
            $this->authorize('viewAny', static::$form_class);
        }

        $query_builder = (new static::$form_class())
            ->filterList($request);
        $list = static::PAGINATE
            ? $list = $query_builder->sortable()->paginate(static::PER_PAGE)
            : $query_builder->get();

        return view('admin.'.static::$form_view.'.list', [
            'controller' => static::class,
            'list' => $list,
            'request' => $request
        ]);
    }

    /**
     * Manage "create" route
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        if(static::AUTHORIZE_BY_POLICY){
            $this->authorize('create', static::$form_class);
        }
        return view('admin.'.static::$form_view.'.create');
    }

    /**
     * Manage "store" route
     *
     * @param Request $request
     * @return \Illuminate\View\View | Mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        if(static::AUTHORIZE_BY_POLICY){
            $this->authorize('create', static::$form_class);
        }
        $form = new static::$form_class();
        $result = $form->store($request);
        if($result['status'] === 'success'){
            $result['entity_label'] = $form::find($result['entity_id'])->{$form::LABEL};
            $result['edit_url'] = 'admin/'.static::$form_view.'/'.$result['entity_id'].'/edit';
        }
        return $result;
    }

    /**
     * Manage "show" route
     * @param $item
     * @param null $step
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($item, $step=null)
    {
        if(static::AUTHORIZE_BY_POLICY){
            $this->authorize('view', (static::$form_class)::find($item));
        }
        $form = new static::$form_class();
        $form = $form->find($item);
        $step = $step ?: static::$form_default_step;
        return view('admin.'.static::$form_view.'.show', [
            'item' => $form,
            'step' => $step
        ]);
    }

    /**
     * Manage "print" route
     * @param $item
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function print($item)
    {
        if(static::AUTHORIZE_BY_POLICY){
            $this->authorize('view', (static::$form_class)::find($item));
        }
        $form = new static::$form_class();
        $form = $form->find($item);
        return view('admin.'.static::$form_view.'.print', [
            'item' => $form,
            'mode' => 'print'
        ]);
    }

    /**
     * Manage "edit" route
     *
     * @param $item
     * @param null $step
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($item, $step=null)
    {
        if(static::AUTHORIZE_BY_POLICY) {
            $this->authorize('update', (static::$form_class)::find($item));
        }
        $form = new static::$form_class();
        $form = $form->find($item);
        $step = $step ?: static::$form_default_step;
        return view('admin.'.static::$form_view.'.edit', [
            'item' => $form,
            'step' => $step
        ]);
    }

    /**
     * Manage "update" route
     *
     * @param $item
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update($item, Request $request)
    {
        if(static::AUTHORIZE_BY_POLICY) {
            $this->authorize('update', (static::$form_class)::find($item));
        }
        return (static::$form_class)::updateModuleAndForm($item, $request);
    }

    /**
     * Manage "destroy" route
     *
     * @param $item
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($item)
    {
        if(static::AUTHORIZE_BY_POLICY) {
            $this->authorize('destroy', (static::$form_class)::find($item));
        }
        $form = new static::$form_class();
        $form = $form->find($item);
        $form->delete();
        return redirect()->action('\\'.static::class.'@index');
    }

    /**
     * Get pair id/name list
     * @param Request $request
     * @return mixed
     */
    public function getList(Request $request)
    {
        HTTP::sanitize($request, static::sanitization_rules);

        $form_class = static::$form_class;
        return $form_class::selectionList('PAIRS',
            $form_class::filterList($request)->get()
        );
    }

    /**
     * Export: Generate and download CSV file
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function csv()
    {
        $collection = (static::$form_class)::exportCollection();
        return File::exportTo('CSV', static::$form_view.'.csv', $collection->toArray());
    }

    /**
     * Export: Generate and download XLS file
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function xls()
    {
        $collection = (static::$form_class)::exportCollection();
        return File::exportTo('XLS',static::$form_view.'.xls', $collection->toArray());
    }

    /**
     * API: model list
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function api_list(Request $request)
    {
        $collection = (static::$form_class)::exportCollection();
        return $this->sendAPIResponse($collection, $request);
    }

    /**
     * API: info for given id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function api_info($id)
    {
        $model = (static::$form_class)::findOrFail($id);
        $models =(static::$form_class)::exportCollection($model);
        return $this->sendAPIResponse($models->toArray());
    }

    /**
     * Generate and stream PDF
     * @param $item
     * @return string
     */
    public function pdf($item)
    {
        $view = view('entities.'.static::$form_view.'.pdf', [
            'item' => (new static::$form_class())->find($item)
        ]);

        return File::exportTo('PDF',static::$form_view.'.pdf', $view);
    }

}