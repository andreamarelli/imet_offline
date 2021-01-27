<?php

namespace App\Models\Imet\v2\Modules\Component;

use App\Library\Ofac\Input\SelectionList;
use App\Library\Utils\Type\JSON;
use App\Models\Currency;

Trait Upgrade
{

    /**
     * Upgrade module record from a previous version (need to be instantiated wherever necessary)
     *
     * @param $records
     * @param bool $v1_to_v2
     * @param null $imet_version
     * @return mixed
     */
    public static function upgradeModuleRecords($records, $v1_to_v2 = false, $imet_version = null)
    {
        foreach ($records as $i=>$record){
            $records[$i] = static::upgradeModule($record, $v1_to_v2, $imet_version);
        }
        return $records;
    }

    /**
     * Upgrade module record from a previous version (need to be instantiated wherever necessary)
     *
     * @param $record
     * @param bool $v1_to_v2
     * @param null $imet_version
     * @return mixed
     */
    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        return $record;
    }

    /**
     * Add a field to the given record (added in newer version)
     *
     * @param $record
     * @param $field
     * @return mixed
     */
    protected static function addField($record, $field)
    {
        if(!array_key_exists($field, $record)){
            $record[$field] = null;
        }
        return $record;
    }

    /**
     * Drop a field from the given record (removed in newer version)
     *
     * @param $record
     * @param $field
     * @return mixed
     */
    protected static function dropField($record, $field)
    {
        if(array_key_exists($field, $record)){
            unset($record[$field]);
            if(array_key_exists($field.'_BYTEA', $record)){
                unset($record[$field.'_BYTEA']);
            }
        }
        return $record;
    }

    /**
     * Replace an obsolete predefined value with a newer one
     *
     * @param $record
     * @param $field
     * @param $old_value
     * @param $new_value
     * @return mixed
     */
    protected static function replacePredefinedValue($record, $field, $old_value, $new_value)
    {
        $record[$field] = $record[$field]===$old_value ? $new_value : $record[$field];
        return $record;
    }

    /**
     * Drop a record if predefined value had been removed
     *
     * @param $record
     * @param $field
     * @param $old_value
     * @return mixed|null
     */
    protected static function dropIfPredefinedValueObsolete($record, $field, $old_value)
    {
        return $record[$field]===$old_value ? null : $record;
    }

    /**
     * Drop a value if not in predefined list
     *
     * @param $value
     * @param $list_key
     * @return mixed
     */
    protected static function dropIfValueNotInPredefinedList($value, $list_key)
    {
        return in_array($value, array_keys(SelectionList::getList('ImetV2_'.$list_key)))
            ? $value
            : null;
    }

    /**
     * Force amount value to the given currency
     *
     * @param $record
     * @param $field_currency
     * @param $fields_to_exchange
     * @return mixed
     */
    protected static function forceCurrency($record, $field_currency, $fields_to_exchange)
    {
        if($record[$field_currency]!==null && !in_array($record[$field_currency], Currency::MINIMAL_CURRENCIES)){
            $currency = $record[$field_currency]==='CFA' ? 'XAF' : $record[$field_currency];
            $record[$field_currency] = 'EUR';
            foreach($fields_to_exchange as $f){
                $record[$f] = Currency::exchange($record[$f], $currency, 'EUR');
            }
        }
        return $record;
    }


}
