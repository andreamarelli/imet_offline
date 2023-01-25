<?php

namespace AndreaMarelli\ModularForms\Models\Utils;

use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\BaseModel;

if(!defined('UPPER_LOCALE')) {
    define('UPPER_LOCALE', Locale::upper());
}
if(!defined('LOWER_LOCALE')) {
    define('LOWER_LOCALE', Locale::lower());
}


abstract class Currency extends BaseModel
{
    protected $table = null;            // to be defined
    protected $primaryKey = null;       // to be defined

    public $incrementing = false;       // needed for non integer primaryKey

    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    public const UPDATED_BY = null;

    public const LABEL = 'name_' . UPPER_LOCALE;

    public const MINIMAL_CURRENCIES = ['EUR', 'USD'];

    /**
     * Exchange rates
     */
    protected const USD_EUR = 0.89;
    protected const GBP_EUR = 1.11;
    protected const CNY_EUR = 0.13;
    protected const JPY_EUR = 0.0082;
    protected const XAF_EUR = 0.0015;
    protected const CFA_EUR = 0.0015;
    protected const STD_EUR = 0.0000411945;
    protected const BIF_EUR = 0.00048;
    protected const CDF_EUR = 0.00054;
    protected const RWF_EUR = 0.00097;


    /**
     * Exchange between 2 given currency
     * @param $amount
     * @param $in_currency
     * @param $out_currency
     * @return float
     */
    public static function exchange($amount, $in_currency, $out_currency): float
    {
        $in_currency = strtoupper($in_currency);
        $out_currency = strtoupper($out_currency);
        if($in_currency!='' && $out_currency!=='' && $in_currency!==$out_currency){
            if($in_currency!=='EUR'){
                // first convert to EUR
                $amount = $amount * constant('static::'.$in_currency.'_EUR');
                // then convert to target currency
                if($out_currency!=='EUR'){
                    $amount = $amount / constant('static::'.$out_currency.'_EUR');
                }
            } else {
                $amount = $amount / constant('static::'.$out_currency.'_EUR');
            }
        }
        return (float) $amount;
    }

}
