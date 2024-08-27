<?php
namespace AndreaMarelli\ImetCore\Helpers;

use Illuminate\Support\Str;


class ModuleKey{

    public const separator = '__';

    /**
     * Return ClassName from module key
     */
    public static function KeyToClassName($module_key): ?string
    {
        $items = explode(self::separator, $module_key);

        $module_class = 'AndreaMarelli\\ImetCore\\Models';
        foreach ($items as $index => $item) {
            if($index===1){
                $module_class .= '\\' . $item; // Version
                $module_class .= '\\Modules';
            } else{
                $module_class .= '\\' . ucfirst(Str::camel($item));
            }
        }
        if (class_exists($module_class)) {
            return $module_class;
        }
        return null;
    }

    /**
     * Return view for the given module
     */
    public static function KeyToView($module_key, $view_mode = null): ?string
    {
        $view = Str::replaceLast(ModuleKey::separator, '.' . $view_mode . '.modules.', $module_key);
        $view = str_replace(ModuleKey::separator, '.', $view);
        $view = Str::replaceFirst('imet.', 'imet-core::', $view);
        if(view()->exists($view)){
            return $view;
        }

        return null;
    }

}
