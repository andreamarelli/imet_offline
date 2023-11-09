<?php

namespace AndreaMarelli\ModularForms\Helpers;

use Illuminate\Support\Facades\DB;


class Module
{

    public static function getModulesList($forms)
    {
        $modules = [];
        foreach ($forms as $form_modules) {
            foreach ($form_modules as $module) {
                if (is_array($module)) {
                    foreach ($module as $moduleOfStep) {
                        if (!in_array($moduleOfStep, $modules)) {
                            $modules[] = $moduleOfStep;
                        }
                    }
                } elseif (!in_array($module, $modules)) {
                    $modules[] = $module;
                }
            }
        }
        return $modules;
    }

    /**
     * Iterate over all modules of the given forms and apply callback function
     *
     * @param $forms
     * @param $callback
     * @param $callback_args
     */
    public static function iterateOverModules($forms, $callback, $callback_args)
    {
        $modules = self::getModulesList($forms);
        foreach ($modules as $moduleClass) {
            $args = $callback_args;
            array_unshift($args, $moduleClass);
            call_user_func($callback, $args);
        }
    }

    /**
     * Check if the given field in a module has records with the given value
     *
     * @param $moduleClass
     * @param $field
     * @param $value
     * @return bool
     */
    public static function checkIfFieldHasValue($moduleClass, $field, $value)
    {
        $db_table = (new $moduleClass())->getTable();
        $res = DB::table($db_table)
            ->selectRaw('count(*)')
            ->where($field, $value)
            ->first();
        return $res->count > 0;
    }

    /**
     * Inject in blade-generated DOM the average calculation for the given GROUP
     *
     * @param $view
     * @param $group
     * @param $num_columns
     * @param $average_column
     * @param string $vModelName
     * @return mixed
     */
    public static function injectAverageInGroup($view, $group, $num_columns, $average_column, $vModelName = 'averages', $average_value = null)
    {
        $searchFor = '<tbody class="' . $group . '">';

        $textToAdd = '';
        for ($c = 1; $c <= $num_columns; $c++) {
            if ($c == $average_column) {
                $v_model = ' v-model="' . $vModelName . '.' . $group . '"';
                $value = "";
                if ($average_value !== null) {
                    $v_model = "";
                    $value = ' value="'.$average_value.'"';
                }
                $textToAdd .= '<td class="text-center">
                                  <input type="text" disabled="disabled" '.$value.' ' . $v_model . ' class="field-disabled input-number field-edit text-center"/>
                               </td>';
            } else {
                $textToAdd .= '<td></td>';
            }
        }
        $textToAdd = '<thead><tr>' . $textToAdd . '</tr></thead>';

        return str_replace($searchFor, $textToAdd . $searchFor, $view);
    }

    /**
     * Inject in blade-generated DOM an additional title for the given GROUPs
     *
     * @param $view
     * @param $module_key
     * @param $beforeGroup
     * @param $title
     * @return mixed
     */
    public static function injectGroupTitle($view, $module_key, $beforeGroup, $title)
    {
        $searchFor = '<h5 class="highlight group_title_' . $module_key . '_' . $beforeGroup . '">';
        $textToAdd = '<h3>' . $title . '</h3>';
        return str_replace($searchFor, $textToAdd . $searchFor, $view);
    }

    /**
     * @param string $field
     * @param string $group
     * @param array $records
     * @return float|int
     */
    public static function calculateAverage(string $field,?string $group, array $records){
        $sum = 0;
        $count = 0;

        $values = $group === null ? $records : $records[$group] ?? [];
        foreach ($values as $item) {
            if ($item[$field] !== null && $item[$field] !== -99 && $item[$field] !== '-99') {
                $sum += (int)$item[$field];
                $count++;
            }
        }

        return $count > 0 ? round($sum / $count , 2) : 0;
    }

    /**
     * @param array $records
     * @return array
     */
    public static function createRecordsArrayByGroup(array $records){
        $new_records = [];
        foreach ($records as $i => $record) {
            $group_key = $record['group_key'];

            if (!isset($new_records[$group_key])) {
                $new_records[$group_key] = [];
            }
            $new_records[$group_key][] = $record;
        }
        return $new_records;
    }

}
