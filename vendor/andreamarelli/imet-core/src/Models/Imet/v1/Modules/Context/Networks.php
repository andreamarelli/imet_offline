<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Type\JSON;
use Illuminate\Support\Str;

class Networks extends Modules\Component\ImetModule
{
    protected $table = 'context_networks';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 1.4';
        $this->module_title = trans('imet-core::v1_context.Networks.title');
        $this->module_fields = [
            ['name' => 'NetworkName',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Networks.fields.NetworkName')],
            ['name' => 'ProtectedAreas',  'type' => 'imet-core::selector-wdpa_multiple',   'label' => trans('imet-core::v1_context.Networks.fields.ProtectedAreas')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_context.Networks.groups.group0'),
            'group1' => trans('imet-core::v1_context.Networks.groups.group1'),
            'group2' => trans('imet-core::v1_context.Networks.groups.group2'),
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

        if($record['ProtectedAreas']!==null && Str::contains($record['ProtectedAreas'], '[')){

            $pas = json_decode($record['ProtectedAreas']);
            $pas = array_filter($pas);

            // Convert local_id to wdpa
            $pas = collect($pas)->map(function ($pa) {
                $model = ProtectedArea::find('OFAC_'.$pa);
                return $model->wdpa_id ?? null;
            })->toArray();
            $pas = array_filter($pas);

            // Convert JSON to comma-separated list
            $record['ProtectedAreas'] = implode(',', $pas);
        }
        return $record;
    }


    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Networks',
            'fields' => [
                'NetworkName', 'ProtectedAreas', 'NetworkType'
            ]
        ];
    }

    /**
     * Review data from SQLITE
     *
     * @param $record
     * @param $sqlite_connection
     * @return array
     */
    protected static function conversionDataReview($record, $sqlite_connection): array
    {
        $record =  self::convertGroupLabelToKey($record, 'NetworkType');

        if(!empty($record['ProtectedAreas'])){
            $pas = json_decode($record['ProtectedAreas']);
            $pas = array_filter($pas);
            $pas = collect($pas)->map(function ($pa) use ($sqlite_connection) {
                return Modules\Component\ImetModule::wdpaBySqliteProtectedAreaID($pa, $sqlite_connection);
            })->toArray();
            $pas = array_filter($pas);
            $record['ProtectedAreas'] = implode(',', $pas);
        }

        return $record;
    }

}
