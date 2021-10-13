<?php

namespace AndreaMarelli\ModularForms\Helpers\Input;

use AndreaMarelli\ModularForms\Helpers\DOM;

class DropDownVue
{

    private static function __initialize($id, $value, $list, $tagAttributes = ''): array
    {
        if (is_string($list)) {
            $list = SelectionList::getList(SelectionList::getListType($list));
        }

        $value         = rtrim($value);
        $tagAttributes = DOM::addClass($tagAttributes, 'field-edit');
        $tagAttributes .= ' v-model="selectedValue" id="' . $id . '" name="' . $id . '" ';

        return [$id, $value, $list, $tagAttributes];
    }

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
                            selectedValue: "' . $value . '"
                        }
                    });
                </script>';
    }

    /**
     * @param $id
     * @param $value
     * @param $list
     * @param string $tagAttributes
     * @param bool $container
     * @return string
     */
    public static function simple($id, $value, $list, $tagAttributes = '', $container = true): string
    {
        list($id, $value, $list, $tagAttributes) = static::__initialize($id, $value, $list, $tagAttributes);
        $vue_component = ' <dropdown-simple
                                data-values="' . htmlspecialchars(json_encode($list), ENT_QUOTES) . '"
                                ' . $tagAttributes . '
                             ></dropdown-simple>';

        if ($container) {
            return static::__vue_component_container('select2_simple_' . $id, $value, $vue_component);
        } else {
            return $vue_component;
        }
    }

    /**
     * @param $id
     * @param $value
     * @param $related_id
     * @param $structure
     * @param string $tagAttributes
     * @return string
     */
    public static function related($id, $value, $related_id, $structure, $tagAttributes = ''): string
    {
        list($id, $value, $_, $tagAttributes) = static::__initialize($id, $value, [], $tagAttributes);

        $vue_component = '<dropdown-related
                            data-structure="' . htmlspecialchars(json_encode($structure), ENT_QUOTES) . '"
                            related-id="' . $related_id . '"
                            ' . $tagAttributes . '
                          ></dropdown-related>';

        return static::__vue_component_container('select2_related_' . $id, $value, $vue_component);
    }

}
