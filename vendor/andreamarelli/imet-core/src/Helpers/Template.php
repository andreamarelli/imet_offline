<?php

namespace AndreaMarelli\ImetCore\Helpers;

use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ModularForms\Helpers\Template as BaseTemplate;

class Template{

    /**
     * Return country flag + name from ISO
     * @param $iso
     * @return string
     * @throws \Exception
     */
    public static function flag_and_name($iso): string
    {
        if($iso!=''){
            $country = Country::getByISO($iso);
            $iso = $country->iso2;
            $label = '&nbsp;'.$country->Name;
            return BaseTemplate::flag($iso, $country->Name).$label;
        }
        return '';
    }

}
