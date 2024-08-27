<?php

namespace AndreaMarelli\ModularForms\Helpers\Type;

class DataArray {

    /**
     * Checking whether the given array is sequential
     */
    public static function isSequential(array $arr): bool
    {
        return array_is_list($arr);
    }

    /**
     * Checking whether the given array is associative
     *
     * @param array $arr
     * @return bool
     */
    public static function isAssociative(array $arr): bool
    {
        return !array_is_list($arr);
    }

}
