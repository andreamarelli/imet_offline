<?php

namespace AndreaMarelli\ModularForms\Helpers\Input;

use AndreaMarelli\ModularForms\Helpers\DOM;
use AndreaMarelli\ModularForms\Helpers\Type\DataArray;

class DropDown
{

    /**
     * Create a simple SELECT input
     *
     * @throws \Exception
     */
    public static function simple($id, $value, string|array $list = '', string $tagAttributes = ''): string
    {
        $value         = rtrim($value);
        $tagAttributes = DOM::addClass($tagAttributes, 'field-edit');

        $list = $list === '' ? $id : $list;
        $list = static::prepare_list($list, $id);

        return '<select name="' . $id . '" id="' . $id . '" ' . $tagAttributes . '>'
                    . static::populate($list, $value) . '
                </select>';
    }

    /**
     * Prepare list
     *
     * @throws \Exception
     */
    public static function prepare_list($list)
    {
        // Retrieve list with SelectionList::getList in case a string is provided (list's key)
        $list = is_string($list)
            ? SelectionList::getList(SelectionList::getListType($list))
            : $list;

        // Transpose sequential arrays to associative (same key/value)
        $list = array_is_list($list)
            ? array_combine($list, $list)
            : $list;

        return $list;
    }

    /**
     * Populate SELECT: generate <option> tags' list
     */
    private static function populate(array $list, string $selectedValue = null): string
    {
        $selectedValue = rtrim($selectedValue);
        $options = $selectedValue == ''
            ? '<option value="" selected="selected"> - - </option>'
            : '<option value=""> - - </option>';
        if (count($list) > 0) {
            foreach ($list as $value => $label) {
                $selected = (strlen($selectedValue) > 0 && $selectedValue == $value) ? 'selected="selected"' : '';
                $options  .= '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
            }
        }
        return $options;
    }
}
