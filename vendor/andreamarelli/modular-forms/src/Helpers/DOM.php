<?php

namespace AndreaMarelli\ModularForms\Helpers;

use Illuminate\Support\Str;

class DOM
{

    /**
     * Add CSS class (or build) to HTML tag "class" attribute
     *
     * @param string $tagAttribute current HTML tag "class" attribute
     * @param string $classToAdd the class name to add
     * @return string
     */
    public static function addClass(string $tagAttribute, string $classToAdd): string
    {
        if($classToAdd!==null && $classToAdd!==''){
            return (Str::contains($tagAttribute, 'class="'))
                ? str_replace('class="', 'class="' . $classToAdd . ' ', $tagAttribute)
                : 'class="' . $classToAdd . '" ' . $tagAttribute;
        }
        return $tagAttribute;
    }

    /**
     * Create CSS class (or build) to HTML tag "class" attribute
     *
     * @param string $rules the rules
     * @return string
     */
    public static function rulesAttribute(string $rules): string
    {
        if($rules!=null && $rules!=''){
            return (Str::contains($rules, 'data-rules="'))
               ? $rules
                : 'data-rules="'.$rules.'"';
        }
        return '';
    }

    /**
     * Build VueJS common attributes (v-bind:id and v-model)
     *
     * @param $id
     * @param $value
     * @return string
     */
    public static function vueAttributes($id, $value): string
    {
        return 'v-model="'.$value.'" '
            .($id!=='' && $id!==null
                ? 'v-bind:id="'.$id.'" '
                : '');
    }

}
