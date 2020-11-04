<?php

namespace App\Library\Ofac;

use App\Library\Utils;
use App\Models\Country;
use App\Models\Institution\Institution;
use App\Models\Person\Person;
use Carbon\Carbon;

class Template{

    public static function partnerLogoLink($label, $url, $img){
        return '<a class="partner_container" href="'.$url.'" target="_blank">
                <img class="logo" src="'.asset('images').'/logos/'.$img.'" />
                <div class="name">'.$label.'</div>
            </a>';
    }

    public static function person($id) {
        $item = Person::find($id);
        if($item){
            $popup = $item->getKey();
            return '<span data-toggle="tooltip" data-placement="top" title="#'.$popup.'">'.$item->Name.'</span>';
        }
        return '';
    }

    public static function date($date){
        if(!empty($date)){
            $day = Carbon::parse($date)->toDateString();
            return '<span data-toggle="tooltip" data-placement="top" title="'.$date.'">'.$day.'</span>';
        }
        return '';
    }

    public static function institution($id) {
        $item = Institution::find($id);
        if($item){
            $popup = $item->getKey()."\n".$item->FullName;
            return '<span data-toggle="tooltip" data-placement="top" title="#'.$popup.'">'.$item->Acronym.'</span>';
        }
        return '';
    }

    public static function flag($iso) {
        if($iso!=''){
            $country = Country::getByISO($iso);
            return Utils\Template::flag($country->iso2, $country->Name);
        }
        return '';
    }

    public static function flag_and_code($iso) {
        if($iso!=''){
            $country = Country::getByISO($iso);
            $iso = $country->iso2;
            $label = '&nbsp;'.$country->iso3;
            return Utils\Template::flag($iso, $country->Name).$label;
        }
        return '';
    }

    public static function flag_and_name($iso) {
        if($iso!=''){
            $country = Country::getByISO($iso);
            $iso = $country->iso2;
            $label = '&nbsp;'.$country->Name;
            return Utils\Template::flag($iso, $country->Name).$label;
        }
        return '';
    }

}