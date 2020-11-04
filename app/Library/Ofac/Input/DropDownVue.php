<?php

namespace App\Library\Ofac\Input;

use App\Library\Utils\DOM;

class DropDownVue
{

    private static function __initialize($id, $value, $list, $tagAttributes = '')
    {
        if (is_string($list)) {
            $list = SelectionList::getList(SelectionList::getListType($list));
        }

        $value         = rtrim($value);
        $tagAttributes = DOM::addStyleClassToTag($tagAttributes, 'field-edit');
        $tagAttributes .= ' v-model="selectedValue" id="' . $id . '" name="' . $id . '" ';

        return [$id, $value, $list, $tagAttributes];
    }

    private static function __vue_component_container($id, $value, $component)
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

    public static function simple($id, $value, $list, $tagAttributes = '', $container = true)
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

    public static function related($id, $value, $related_id, $structure, $tagAttributes = '')
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