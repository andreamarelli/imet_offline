<?php

namespace App\Models\Components;


class ModuleKey
{

    // Todo: need to manage the Modules' subfolder (Ex Imet with Context / Evaluation)

    public const separator = '__';

    /**
     * Return module key from ClassName
     *
     * @param $class_name
     * @return string
     */
    public static function ClassNameToKey($class_name)
    {
        $class_name = gettype($class_name) === 'object' ? get_class($class_name) : $class_name;
        $class_name = str_replace('App\\Models\\', '', $class_name);
        $class_name = str_replace('Modules\\', '', $class_name);
        $module_key = '';
        foreach (explode('\\', $class_name) as $item) {
            $module_key .= \Str::snake($item) . self::separator;
        }
        $module_key = \Str::replaceLast(self::separator, '', $module_key);
        return $module_key;
    }

    /**
     * Return ClassName from module key
     *
     * @param $module_key
     * @return string
     */
    public static function KeyToClassName($module_key)
    {
        $items = explode(self::separator, $module_key);

        // Form
        $module_class = 'App\\Models\\' . ucfirst(\Str::camel($items[0]));
        array_shift($items);
        // Version (optional)
        if (preg_match("/v\d/i", $items[0])) {
            $module_class .= '\\' . $items[0];
            array_shift($items);
        }
        // Modules folder
        $module_class .= '\\Modules';
        // sub-folders (optional) and class name
        foreach ($items as $item) {
            $module_class .= '\\' . ucfirst(\Str::camel($item));
        }
        return $module_class;
    }

    /**
     * Return view for the given module
     *
     * @param $module_key
     * @param null $view_type (null, 'vue' or 'preview')
     * @return string
     */
    public static function KeyToView($module_key, $view_type = null)
    {
        $path = 'modules';
        if ($view_type == 'vue') {
            $path = 'vue';
        } elseif ($view_type == 'preview') {
            $path = 'modules_preview';
        }

        $view = 'admin.' . $module_key;
        $view = \Str::replaceLast(self::separator, '.' . $path . '.', $view);
        $view = str_replace(self::separator, '.', $view);
        return $view;
    }


}