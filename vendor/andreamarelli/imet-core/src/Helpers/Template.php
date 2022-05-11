<?php

namespace AndreaMarelli\ImetCore\Helpers;

use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
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
            return BaseTemplate::flag($iso, $country->Name);
        }
        return '';
    }

    public static function module_scope($scope){
        $common_attributes = 'data-toggle="tooltip" data-placement="top"';
        if($scope==ImetModule::TERRESTRIAL_AND_MARINE){
            return '<img src="/assets/images/tree.png" '.$common_attributes.' data-original-title="' . ucfirst(trans('imet-core::v2_common.terrestrial')) . '" />
                        <img src="/assets/images/fish.png" '.$common_attributes.' data-original-title="' . ucfirst(trans('imet-core::v2_common.marine')) . '" />';
        } elseif ($scope==ImetModule::TERRESTRIAL){
            return '<img src="/assets/images/tree.png" '.$common_attributes.' data-original-title="' . ucfirst(trans('imet-core::v2_common.terrestrial')) . '" />';
        } elseif ($scope==ImetModule::MARINE){
            return '<img src="/assets/images/fish.png" '.$common_attributes.' data-original-title="' . ucfirst(trans('imet-core::v2_common.marine')) . '" />';
        }
    }

}
