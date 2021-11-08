<?php

namespace AndreaMarelli\ModularForms\Helpers;

use Illuminate\Support\Str;


class ModuleKey
{

    public const separator = '__';

    /**
     * Return module key from ClassName
     *
     * @param $class_name
     * @return string
     */
    public static function ClassNameToKey($class_name): string
    {
        $class_name = gettype($class_name) === 'object' ? get_class($class_name) : $class_name;
        $class_name = preg_replace("/[\w\\\\]+Models\\\\/i", '', $class_name);
        $class_name = str_replace('Modules\\', '', $class_name);
        $module_key = '';
        foreach (explode('\\', $class_name) as $item) {
            $module_key .= Str::snake($item) . self::separator;
        }
        $module_key = Str::replaceLast(self::separator, '', $module_key);
        return $module_key;
    }

    /**
     * Return ClassName from module key
     *
     * @param $module_key
     * @return string
     */
    public static function KeyToClassName($module_key): ?string
    {
        $items = explode(self::separator, $module_key);

        // Standard namespace
        $module_class = 'App\\Models';
        foreach ($items as $index => $item) {
            $module_class .= '\\' . ucfirst(Str::camel($item));
            if($index===0){
                $module_class .= '\\Modules';
            }
        }
        if (class_exists($module_class)) {
            return $module_class;
        }

        // Custom namespaces (try to retrieve from helper function)
        if(function_exists('get_custom_model_class_by_key')){
            $module_class = get_custom_model_class_by_key($module_key);
            if ($module_class !== null) {
                return $module_class;
            }
        }

        PhpClass::ClassExist($module_class);
        return null;
    }

    /**
     * Return view for the given module
     *
     * @param $module_key
     * @param null $view_type (null, or 'show')
     * @return string|null
     */
    public static function KeyToView($module_key, $view_type = null): ?string
    {
        $path = $view_type == 'show'
            ? 'modules_show'
            : 'modules';

        // Standard view location
        $view = 'admin.' . $module_key;
        $view = Str::replaceLast(self::separator, '.' . $path . '.', $view);
        $view = str_replace(self::separator, '.', $view);
        if(view()->exists($view)){
            return $view;
        }

        // Custom view location (try to retrieve from helper function)
        if(function_exists('get_custom_model_view_by_key')){
            $view = get_custom_model_view_by_key($module_key, $view_type);
            if(view()->exists($view)){
                return $view;
            }
        }

        return null;
    }


}
