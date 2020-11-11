<?php

namespace App\Http\Controllers\Imet;

use App\Http\Controllers\Components\FormController;
use App\Library\Utils\File\File;
use App\Models\Imet\Utils\ProtectedArea;
use App\Models\Imet\v2\Imet;
use App\Models\Imet\v2\Modules;
use Illuminate\Http\Request;


class ImetControllerV2 extends FormController
{
    use Report;

    protected static $form_class = Imet::class;
    protected static $form_view = 'imet/v2/context';
    protected static $form_default_step = 'general_info';

    public const AUTHORIZE_BY_POLICY = true;

    /**
     * Retrieve existing previous forms
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function retrieve_prev_years(Request $request)
    {
        $wdpa_id = ProtectedArea::getByWdpa($request->input('wdpa_id'))->wdpa_id;
        return Imet::select(['FormID','Year','wdpa_id'])
            ->where('wdpa_id', $wdpa_id)
            ->where('Year', '<', $request->input('year'))
            ->orderByDesc('Year')
            ->get()
            ->pluck('Year', 'FormID');
    }

    public function store(Request $request)
    {
        $records = json_decode($request->input('records_json'), true);

        // Export previous existing form and save as new (if selected)
        $prev_year_selection = $records[0]['prev_year_selection'] ?? null;
        if($prev_year_selection!==null && $prev_year_selection!=='no_import'){
            return (new ImetController)->store_prefilled($request);
        }

        // Create new form
        return parent::store($request);
    }

    /**
     * Manage "pdf" route
     *
     * @param $item
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\BinaryFileResponse|null
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function pdf($item)
    {
        $this->authorize('view', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $view = view('admin.'.static::$form_view.'.print', [
            'item' => $form
        ]);
        return File::exportTo('PDF', $form->filename('pdf'), $view);
    }

}
