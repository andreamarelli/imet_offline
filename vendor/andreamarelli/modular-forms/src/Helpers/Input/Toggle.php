<?php

namespace AndreaMarelli\ModularForms\Helpers\Input;


class Toggle
{

    /**
     * @param $id
     * @param $value
     * @param $component
     * @return string
     */
    private static function __vue_component_container($id, $value, $component): string
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
