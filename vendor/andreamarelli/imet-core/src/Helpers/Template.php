<?php

namespace AndreaMarelli\ImetCore\Helpers;

use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\Imet\Components\Modules\ImetModule;
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
            $label = '&nbsp;'.$country->name;
            return BaseTemplate::flag($iso, $country->name).$label;
        }
        return '';
    }

    /**
     * Return country flag from ISO
     *
     * @param $iso
     * @return string
     * @throws \Exception
     */
    public static function flag($iso): string
    {
        if($iso!=''){
            $country = Country::getByISO($iso);
            $iso = $country->iso2;
            return BaseTemplate::flag($iso);
        }
        return '';
    }

    /**
     * Return scope icon (marine or terrestrial)
     *
     * @param $scope
     * @return string
     */
    public static function module_scope($scope): string
    {
        if($scope !== null){
            return "<scope-icon scope='" . $scope . "'></scope-icon>";
        }

        return '';
    }

}
