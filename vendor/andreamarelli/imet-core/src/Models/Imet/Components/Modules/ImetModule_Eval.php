<?php

namespace AndreaMarelli\ImetCore\Models\Imet\Components\Modules;

class ImetModule_Eval extends ImetModule
{

    /**
     * Override: compared on "IncludeInStatistics" flag
     * @param $form_id
     * @param $updatedRecords
     * @param $dependencyClasses
     */
    public static function dropFromDependencies($form_id, $updatedRecords, $dependencyClasses)
    {
        $reference_field = (new static())->module_fields[0]['name'];

        $toBeDropped = static::getModule($form_id)->filter(function($item){
            return $item['IncludeInStatistics'];
        })
            ->pluck($reference_field)->diff(
                collect($updatedRecords)->filter(function($item){
                    return $item['IncludeInStatistics'];
                })->pluck($reference_field)
            )->all();
        $toBeDropped = array_values($toBeDropped);

        foreach ($dependencyClasses as $class){
            $class::dropListed($form_id, $toBeDropped);
        }
    }


}
