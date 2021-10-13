<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\Utils\Country as BaseCountry;


/**
 * Class Country
 *
 * @property integer $iso2
 * @property integer $iso3
 * @property string $name
 * @property string $Name
 *
 * @package AndreaMarelli\ImetCore\Models
 */
class Country extends BaseCountry
{

    protected $table = 'imet.imet_countries';
    public $primaryKey = 'iso3';


}
