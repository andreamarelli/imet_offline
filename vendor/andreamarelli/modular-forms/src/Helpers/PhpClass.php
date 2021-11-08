<?php

namespace AndreaMarelli\ModularForms\Helpers;

class PhpClass
{

    /**
     * Check if the class exists
     *
     * @param string $class_name
     * @return void
     */
    public static function ClassExist(string $class_name)
    {
        if (!class_exists($class_name)) {
            dd($class_name . ' not found!');
        }
    }

    /**
     * Get Class name without full namespace
     *
     * @param string $class_name
     * @return string
     * @throws \ReflectionException
     */
    public static function ClassWithoutNamespace(string $class_name): string
    {
        return (new \ReflectionClass($class_name))->getShortName(); // this is much faster than explode
//        return end(explode('\\', $class_name));
    }

}
