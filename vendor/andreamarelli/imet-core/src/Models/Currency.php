<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Models\Utils\Currency as BaseCurrency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class Currency
 *
 * @property string $iso
 * @property string $name_fr
 * @property string $name_en
 * @property string $name_sp
 *
 * @package AndreaMarelli\ImetCore\Models
 */
class Currency extends BaseCurrency
{
    protected $table = 'imet.imet_currencies';
    protected $primaryKey = 'iso';

    /**
     * Override: get locale of IMET form
     *
     * @param string $type
     * @param Collection|null $collection
     * @param array $fields
     * @return array
     */
    public static function imetV1List(string $type = 'PAIRS', Collection $collection = null, array $fields = []): array
    {
        $lang = App::getLocale() ?? Config::get('app.locale');
        return parent::selectionList('FIELDS', $collection, ['name_'.$lang, 'iso3']);
    }

}
