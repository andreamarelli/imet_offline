<?php

namespace AndreaMarelli\ModularForms\Helpers\Input;


class Toggle
{

    /**
     * @param $id
     * @param $value
     * @param $list
     * @param string $tagAttributes
     * @return string
     * @throws \Exception
     */
    public static function simple($id, $value, $list, $tagAttributes = ''): string
    {
        if (is_string($list)) {
            $list = SelectionList::getList(SelectionList::getListType($list));
        }

        $tagAttributes .= ' v-value="' . rtrim($value) . '" id="' . $id . '" ';

        return
            '<toggle
                data-values="' . htmlspecialchars(json_encode($list), ENT_QUOTES) . '"
                ' . $tagAttributes . '
            ></toggle>';
    }

}
