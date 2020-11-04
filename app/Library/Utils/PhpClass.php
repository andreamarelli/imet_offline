<?php

namespace App\Library\Utils;

class PhpClass
{

    /**
     * Check if the class exists
     *
     * @param string $class_name
     * @return void
     */
    public static function ClassExist($class_name)
    {
        if (!class_exists($class_name)) {
            dd($class_name . ' not found!');
        }
    }

    /**
     * Get Class name without full namespace
     *
     * @param $class_name
     * @return string
     * @throws \ReflectionException
     */
    public static function ClassWithoutNamespace($class_name)
    {
        return (new \ReflectionClass($class_name))->getShortName(); // this is much faster than explode
//        return end(explode('\\', $class_name));
    }

}
