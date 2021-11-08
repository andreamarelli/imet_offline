<?php

namespace AndreaMarelli\ModularForms\Helpers\Type;

class DataArray {

    /**
     * Checking whether the given array is zero-indexed and sequential
     *
     * @param array $arr
     * @return bool
     */
    public static function isSequential(array $arr): bool
    {
        if (DataArray::hasStringKey($arr)) return false;
        return array() === $arr
                || array_keys($arr) === range(0, count($arr) - 1);
    }

    /**
     * Checking whether the given array is associative array
     *
     * @param array $arr
     * @return bool
     */
    public static function isAssociative(array $arr): bool
    {
        return !DataArray::isSequential($arr);
    }

    /**
     * Check whether the array has string keys
     *
     * @param array $arr
     * @return bool
     */
    public static function hasStringKey(array $arr): bool
    {
        return count(array_filter(array_keys($arr), 'is_string')) > 0;
    }


}
