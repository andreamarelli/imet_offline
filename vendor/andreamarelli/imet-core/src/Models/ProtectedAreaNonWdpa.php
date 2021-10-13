<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Models\BaseModel;


/**
 * Class ProtectedAreaNonWdpa
 *
 * @property string $id
 * @property string $wdpa_id
 * @property string $name
 * @property string $country
 * @property string $Type
 * @property string $iucn_category
 * @property string $creation_date
 *
 */
class ProtectedAreaNonWdpa extends BaseModel
{
    protected $table = 'imet.imet_pas_non_wdpa';

    public const LABEL = 'name';

    private const START_FAKE_ID = 999990000;

    protected $guarded = [];

    protected $appends = ['wdpa_id'];

    /**
     * Append "wdpa_id" as id alias
     *
     * @return string
     */
    public function getWdpaIdAttribute(): string
    {
        return $this->id;
    }

    /**
     * Generate a fake wdpa id
     *
     * @return int|mixed|string
     */
    public static function generate_fake_wdpa()
    {
        $max_id = ProtectedAreaNonWdpa::max('id');
        return $max_id===null
            ? static::START_FAKE_ID
            : $max_id + 1;
    }

    /**
     * Check if the the given id is a fake WDPA or not
     *
     * @param $wdpa_id
     * @return bool
     */
    public static function isNonWdpa($wdpa_id): bool
    {
        return $wdpa_id >= ProtectedAreaNonWdpa::START_FAKE_ID;
    }

    /**
     * Export to JSON
     *
     * @return array
     */
    public static function export($id): array
    {
        return static::find($id)
            ->makeHidden([static::UPDATED_AT, static::UPDATED_BY])
            ->toArray();
    }

    /**
     * Import from JSON
     * @param $data
     * @return mixed
     */
    public static function import($data)
    {
        unset($data['wdpa_id']);
        unset($data['id']);

        $pa = ProtectedAreaNonWdpa::firstOrNew($data);
        if($pa->isDirty()){
            $pa->id = ProtectedAreaNonWdpa::generate_fake_wdpa();
            $pa->save();
        }
        return $pa->id;
    }


}
