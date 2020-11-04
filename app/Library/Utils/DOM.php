<?php

namespace App\Library\Utils;

class DOM
{

    /**
     * Add CSS classes to HTML tags
     *
     * @param String $tagAttributes current TAG attributes
     * @param String $classToAdd the class name to add
     * @return  String
     */
    public static function addStyleClassToTag($tagAttributes, $classToAdd)
    {
        return (substr_count($tagAttributes, 'class="') > 0)
            ? str_replace('class="', 'class="' . $classToAdd . ' ', $tagAttributes)
            : 'class="' . $classToAdd . '" ' . $tagAttributes;
    }

}