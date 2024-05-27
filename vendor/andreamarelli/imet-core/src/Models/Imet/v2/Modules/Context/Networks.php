<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Type\JSON;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Support\Str;

class Networks extends Modules\Component\ImetModule
{
    protected $table = 'context_networks';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 1.4';
        $this->module_title = trans('imet-core::v2_context.Networks.title');
        $this->module_fields = [
            ['name' => 'NetworkName',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Networks.fields.NetworkName')],
            ['name' => 'ProtectedAreas',  'type' => 'imet-core::selector-wdpa_multiple',   'label' => trans('imet-core::v2_context.Networks.fields.ProtectedAreas')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.Networks.groups.group0'),
            'group1' => trans('imet-core::v2_context.Networks.groups.group1'),
            'group2' => trans('imet-core::v2_context.Networks.groups.group2'),
        ];

        parent::__construct($attributes);
    }

    /**
     * Override: upgrade module records during retrieving
     *
     * @param int|null $form_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public static function getModule(int $form_id = null)
    {
        $models = parent::getModule($form_id);

        // Upgrade existing data
        $models->map(function ($model){
            $model->timestamps = false;
            $model->fill(
                static::upgradeModule($model->toArray())
            )->save();
        });

        return $models;
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ### Update "ProtectedAreas" to comma-separated list of WDPA ids ###
        if($record['ProtectedAreas']!==null && Str::contains($record['ProtectedAreas'], '_')){

            $pas = explode(',', $record['ProtectedAreas']);

            // Convert global_id to wdpa
            $pas = collect($pas)->map(function ($pa) {
                if(Str::startsWith($pa, 'OFAC_')){
                    $model = ProtectedArea::find($pa);  // for OFAC: global_id is 'OFAC_' + local_id
                    return $model->wdpa_id ?? null;
                } else{
                    return explode('_', $pa)[1]; // for other regions: global_id is region + wdpa
                }
            })->toArray();

            // Convert JSON to comma-separated list
            $record['ProtectedAreas'] = implode(',', $pas);
        }

        return $record;
    }
}
