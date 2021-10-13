<?php

namespace AndreaMarelli\ModularForms\Models\Utils;

use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;


abstract class Country extends BaseModel
{
    protected $table = null;            // to be defined
    protected $primaryKey = null;       // to be defined

    public $incrementing = false;

    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    public const UPDATED_BY = null;

    public const LABEL = 'name_' . LOWER_LOCALE;

    protected $appends = ['name'];

    /**
     * Accessor: "name" (in the locale language)
     *
     * @return mixed
     */
    public function getNameAttribute()
    {
        return $this->attributes[static::LABEL];
    }

    /**
     * Get country by iso
     *
     * @param $iso
     * @return \AndreaMarelli\ModularForms\Models\Utils\Country|\Illuminate\Database\Eloquent\Model|object|null
     * @throws \Exception
     */
    public static function getByISO($iso)
    {
        $iso = strtoupper($iso);
        if(strlen($iso)==2){
            return static::where('iso2', $iso)->first();
        } elseif(strlen($iso)==3){
            return static::where('iso3', $iso)->first();
        } else {
            throw new \Exception('Wrong size for iso: '. $iso);
        }
    }

    /**
     * Override: get list according to locale of IMET form
     * @param string $type
     * @param Collection|null $collection
     * @param array $fields
     * @return array
     */
    public static function selectionList($type = 'PAIRS', Collection $collection = null, $fields = []): array
    {
        $lang = App::getLocale() ?? Config::get('app.locale');
        return parent::selectionList('FIELDS', $collection, ['name_'.$lang, 'iso3']);
    }


}
