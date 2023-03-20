<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Component;

use AndreaMarelli\ImetCore\Exceptions\MissingDependencyConfigurationException;
use Illuminate\Support\Str;

trait Dependencies{

    protected static $DEPENDENCY_ON = null;
    protected static $DEPENDENCIES = null;

    /**
     * Check for "warning_on_save" in labels end push to vue_data
     *
     * @param $vue_data
     * @return array
     */
    public static function warningOnSave($vue_data): array
    {
        $this_class = static::class;
        $array_this_class = explode('\\', $this_class);
        $this_class_name = end($array_this_class);
        $labels = null;
        if(Str::contains($this_class, 'Modules\Context')){
            $label_prefix = 'imet-core::oecm_context.';
            $labels = trans($label_prefix . $this_class_name);
        } else if(Str::contains($this_class, 'Modules\Evaluation')){
            $label_prefix = 'imet-core::oecm_evaluation.';
            $labels = trans($label_prefix . $this_class_name);
        }
        if(is_array($labels) && array_key_exists('warning_on_save', $labels)){
            $vue_data['warning_on_save'] =  trans($label_prefix . $this_class_name . '.warning_on_save');
        }

        return $vue_data;
    }

    /**
     * Compare updated records with existing (in DB) and drop from dependant modules
     *
     * @param $records
     * @param $form_id
     * @return void
     */
    protected static function updateDependencies($records, $form_id)
    {
        if(static::$DEPENDENCIES !== null){

            foreach (static::$DEPENDENCIES as $dependency){

                $dependency_class = $dependency[0];
                $dependency_on = $dependency[1];
                $dependency_to = $dependency[2] ?? null;

                $to_be_dropped = static::getRecordsToBeDropped($records, $form_id, $dependency_on);

                $dependency_class::dropOrphansDependencyRecords($form_id, $to_be_dropped, $dependency_to);
            }
        }
    }

    /**
     * Compare updated records with existing
     *
     * @param $records
     * @param $form_id
     * @param $dependency_on
     * @return array
     */
    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = static::getModule($form_id)->pluck($dependency_on)->unique()->toArray();
        $updated_values = collect($records)->pluck($dependency_on)->unique()->toArray();

        // Make diff to find out what to drop
        $to_be_dropped = array_diff($existing_values, $updated_values);
        return array_values($to_be_dropped);
    }

    /**
     * Drop orphans records (where reference field values had been removed form parent) adn propagate to eventual related dependencies
     *
     * @param $form_id
     * @param $to_be_dropped
     * @param null $dependency_on
     * @return void
     * @throws MissingDependencyConfigurationException
     */
    public static function dropOrphansDependencyRecords($form_id, $to_be_dropped, $dependency_on = null)
    {
        if($dependency_on==null && static::$DEPENDENCY_ON === null){
            throw new MissingDependencyConfigurationException(static::class);
        } else {

            $dependency_on = $dependency_on ?? static::$DEPENDENCY_ON;

            // Drop records (where reference field values had been removed form parent)
            $records_to_be_dropped = static::getModule($form_id)
                ->filter(function ($record) use($to_be_dropped, $dependency_on){
                    return in_array($record[$dependency_on], $to_be_dropped);
                })
                ->toArray();

            foreach ($records_to_be_dropped as $record) {
                static::destroy($record[(new static())->primaryKey]);
            }

            // Propagate to eventual related dependencies
            static::propagateDropOrphansDependencyRecords($form_id, $records_to_be_dropped);
        }

    }

    /**
     * Propagate to eventual related dependencies
     *
     * @param $form_id
     * @param $records_to_be_dropped
     * @return void
     */
    private static function propagateDropOrphansDependencyRecords($form_id, $records_to_be_dropped)
    {
        if(static::$DEPENDENCIES !== null){
            foreach (static::$DEPENDENCIES as $dependency){

                $dependency_class = $dependency[0];
                $dependency_on = $dependency[1];
                $dependency_to = $dependency[2] ?? null;

                $to_be_dropped_from_dependency = [];
                foreach ($records_to_be_dropped as $record){
                    $to_be_dropped_from_dependency[] = $record[$dependency_on];
                }
                $to_be_dropped_from_dependency = array_unique($to_be_dropped_from_dependency);
                $dependency_class::dropOrphansDependencyRecords($form_id, $to_be_dropped_from_dependency, $dependency_to);
            }
        }
    }



}