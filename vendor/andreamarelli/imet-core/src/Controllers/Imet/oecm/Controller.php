<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\oecm;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller as BaseController;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\CreateAndStoreNonWdpa;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Prefill;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\GeneralInfo;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use AndreaMarelli\ModularForms\Models\Traits\Payload;

class Controller extends BaseController
{
    use Prefill;
    use CreateAndStoreNonWdpa;

    public const ROUTE_PREFIX = 'imet-core::oecm.';

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::oecm';

    private static function redirect_to_edit($request)
    {
        $form = new static::$form_class();
        $result = $form->store($request);

        $form_id = $form->getKey();
        $non_wdpa_id = Payload::decode($request->input('records_json'))[0]['wdpa_id'];
        $non_wdpa = ProtectedAreaNonWdpa::find($non_wdpa_id);

        GeneralInfo::create([
            'FormID' => $form_id,
            'CompleteName' => $non_wdpa->name,
            'Country' => $non_wdpa->country,
            'Ownership' => SelectionList::getList('ImetV2_OwnershipType')[$non_wdpa->ownership_type],
            'CreationYear' => $non_wdpa->status_year
        ]);

        if($result['status'] === 'success'){
            $result['entity_label'] = $form::find($result['entity_id'])->{$form::LABEL};
            $result['edit_url'] = route(static::ROUTE_PREFIX. 'context_edit', ['item' => $result['entity_id']]);
        }
        return $result;
    }

}
