<?php

namespace AndreaMarelli\ModularForms\Helpers\Input;

use AndreaMarelli\ModularForms\Helpers\Type\DataArray;
use Exception;
use Illuminate\Support\Facades\Session;


class SelectionList
{

    public static function getListType($type)
    {
        $list_type = preg_replace('/dropdown[\w]*-/', '', $type);
        $list_type = preg_replace('/suggestion[\w]*-/', '', $list_type);
        $list_type = preg_replace('/toggle[\w]*-/', '', $list_type);
        $list_type = preg_replace('/checkbox[\w]*-/', '', $list_type);
        $list_type = preg_replace('/selector[\w]*-/', '', $list_type);
        return $list_type;
    }

    /**
     * Get a list of "$type" elements.
     *
     * @param $type
     * @return array
     * @throws \Exception
     */
    public static function getList($type)
    {
        $type       = SelectionList::getListType($type);
        $list       = [];
        $create_url = null;

        // Try to retrieve the list from the get_custom_list() helper function
        if(function_exists('get_custom_list')){
            $list = get_custom_list($type);
            if(!empty($list)){

                // Transpose sequential arrays to associative (same key/value)
                if (!is_string($list) && DataArray::isSequential($list)) {
                    $list = array_combine($list, $list);
                }

                return $list;
            }
        }

        if ($type == 'yes_no') {
            $list = [
                'true' => trans('modular-forms::common.yes'),
                'false' => trans('modular-forms::common.no')
            ];
        } elseif ($type == 'yes_no_text') {
            $list = [
                trans('modular-forms::common.yes'),
                trans('modular-forms::common.no')
            ];
        } elseif( $type === "currency-unit-minimal"){
            $list = [
                "EUR" => "Euro",
                "USD" => "US Dollar"
            ];
        }

        // Raise Exception if list not found
        if(empty($list)
            && $type!=='boolean'
            && $type!=='boolean_numeric'){
            throw new Exception('List "'.$type.'" not found.');
        }

        return $list;
    }

    /**
     * Return cached lists (retrieve and add if missing)
     *
     * @param $list_type
     * @return mixed
     * @throws \Exception
     */
    public static function CacheListInSession($list_type)
    {
        if (!Session::has('lists')) {
            Session::put('lists', []);
        }
        $cached_lists = Session::get('lists');
        if (!array_key_exists($list_type, $cached_lists)) {
            $cached_lists[$list_type] = static::getList($list_type);
            Session::forget('lists');
            Session::put('lists', $cached_lists);
        }
        return $cached_lists[$list_type];
    }

    public static function forceListInSession($list_type, $list)
    {
        if (!Session::has('lists')) {
            Session::put('lists', []);
        }
        $cached_lists             = Session::get('lists');
        $cached_lists[$list_type] = $list;
        Session::forget('lists');
        Session::put('lists', $cached_lists);
    }

    /**
     * Retrieve the label of the given list item
     *
     * @param string $type
     * @param null $value
     * @return string|null
     * @throws \Exception
     */
    public static function getLabel(string $type, $value = null): ?string
    {
        $list_type = SelectionList::getListType($type);
        $list      = SelectionList::getList($list_type);
        if ($value != null && array_key_exists($value, $list)) {
            return $list[$value];
        }
        return null;
    }

    /**
     * Inject a list to a Vue component
     * @param $list
     * @return string
     * @throws \Exception
     */
    public static function toVueComponent($list): string
    {
        if (is_string($list)) {
            $list = static::getList($list);
        }
        return htmlspecialchars(json_encode($list), ENT_QUOTES);
    }

}
