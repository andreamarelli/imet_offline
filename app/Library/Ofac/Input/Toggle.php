<?php

namespace App\Library\Ofac\Input;

use App\Library\Utils\DOM;

class Toggle
{

    private static function __vue_component_container($id, $value, $component)
    {
        return '<div id="' . $id . '">
                    ' . $component . '
                </div>
                <script>
                     new Vue({
                        el: "#' . $id . '",
                        data: {
                            inputValue: "' . $value . '"
                        }
                    });
                </script>';
    }


    public static function simple($id, $value, $list, $tagAttributes = '')
    {
        if (is_string($list)) {
            $list = SelectionList::getList(SelectionList::getListType($list));
        }

        $value         = rtrim($value);
        $tagAttributes .= ' v-model="inputValue" id="' . $id . '" ';

        $vue_component =
            '<toggle
                data-values="' . htmlspecialchars(json_encode($list), ENT_QUOTES) . '"
                ' . $tagAttributes . '
            ></toggle>';

        return static::__vue_component_container('toggle_' . $id, $value, $vue_component);
    }

}