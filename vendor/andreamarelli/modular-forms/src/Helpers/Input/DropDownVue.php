<?php

namespace AndreaMarelli\ModularForms\Helpers\Input;


class DropDownVue
{
    /**
     * Create a vue based dropdown
     *
     * @throws \Exception
     */
    public static function simple($id, $value, $list, string $tagAttributes = ''): string
    {
        $list = DropDown::prepare_list($list);

        return '<div id="dropdown_simple_' . $id . '">
                    <dropdown v-model="selectedValue"
                        :data-values=options
                        ' . $tagAttributes .'
                    ></dropdown>
                    <input type="hidden" name="'.$id.'" id="'.$id.'" value="' . $value . '" >
                </div>
                <script>
                     new Vue({
                        el: "#dropdown_simple_' . $id . '",
                        data: {
                            selectedValue: "' . $value . '",
                            options: \''. json_encode($list) . '\'
                        },
                        watch: {
                            selectedValue(value){
                                document.querySelector("#' . $id . '").value = value;
                                document.querySelector("#' . $id  . '").dispatchEvent(new Event("change"));
                            }
                        }
                    });
                </script>';
    }

    /**
     * Create a vue based dropdown where the available options depend on a related dropdown selection
     */
    public static function related($id, $value, $related_id, $structure, string $tagAttributes = ''): string
    {
        return '<div id="dropdown_related_' . $id . '">
                   <dropdown-related
                        v-model=selectedValue
                        :input-value=selectedValue
                        :data-structure=options
                        related-id="' . $related_id .'"
                        ' . $tagAttributes .'
                    ></dropdown-related>
                    <input type="hidden" name="'.$id.'" id="'.$id.'" value="' . $value . '" >
                </div>
                <script>
                     new Vue({
                        el: "#dropdown_related_' . $id . '",
                        data: {
                            selectedValue: "' . $value . '",
                            options: '. json_encode($structure) . '
                        },
                        watch: {
                            selectedValue(value){
                                document.querySelector("#' . $id . '").value = value;
                            }
                        }
                    })
                </script>';
    }

}
