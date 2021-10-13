<?php

namespace AndreaMarelli\ModularForms\Helpers\Input;

use AndreaMarelli\ModularForms\Helpers\DOM;
use AndreaMarelli\ModularForms\Helpers\Type\DataArray;

class DropDown
{
    /**
     * Create a simple SELECT input
     *
     * @param $id
     * @param $value
     * @param string|array $list
     * @param string $tagAttributes
     * @return string
     * @throws \Exception
     */
    public static function simple($id, $value, $list = '', $tagAttributes = ''): string
    {
        $value         = rtrim($value);
        $tagAttributes = DOM::addClass($tagAttributes, 'field-edit');

        $list = $list === '' ? $id : $list;
        $list = is_string($list) ? SelectionList::getList($list) : $list;
        $list = DataArray::isSequential($list) ? array_combine($list, $list) : $list;

        return '<select name="' . $id . '" id="' . $id . '" ' . $tagAttributes . '>'
                    . static::populate($list, $value) . '
                </select>';
    }

    /**
     * Populate SELECT: generate <option> tags' list
     *
     * @param array $list the options' value/label pairs
     * @param string|null $selectedValue the selected value
     * @return  string  HTML code
     */
    private static function populate(array $list, $selectedValue = null): string
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
