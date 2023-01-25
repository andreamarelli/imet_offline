<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\v1;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller as BaseController;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;


class Controller extends BaseController
{
    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v1.context';
    protected static $form_default_step = 'general_info';

    protected static $total_budget = 0;
    protected static $financial_available_resources_totals = 0;

    public static function get_records_total_budget()
    {
        return static::$total_budget;
    }

    /**
     * @param $value
     * @return void
     */
    public static function set_records_total_budget($value){
        static::$total_budget = $value;
    }

    public static function get_financial_available_resources_totals()
    {
        return static::$financial_available_resources_totals;
    }

    /**
     * @param $value
     * @return void
     */
    public static function set_financial_available_resources_totals($value){
        static::$financial_available_resources_totals = $value;
    }

}
