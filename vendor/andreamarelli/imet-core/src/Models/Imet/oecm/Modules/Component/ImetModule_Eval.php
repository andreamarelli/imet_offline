<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Component;


use AndreaMarelli\ImetCore\Models\Imet\Components\Modules\ImetModule_Eval as BaseImetEvalModule;
use AndreaMarelli\ImetCore\Models\Imet\Components\Upgrade;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElements;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraintsIntegration;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ThreatsIntegration;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use ReflectionException;

class ImetModule_Eval extends BaseImetEvalModule
{
    use Upgrade;
    use Dependencies;
    public const MODULE_SCOPE = null;

    protected static $form_class = Imet::class;

    /**
     * Override: Check for "warning_on_save" labels
     * @param $form_id
     * @param $collection
     * @return array
     * @throws ReflectionException
     */
    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);
        $vue_data = static::warningOnSave($vue_data);
        return $vue_data;
    }

    /**
     * Override: update dependent modules
     * @param $records
     * @param $form_id
     * @return array|void
     * @throws FileNotFoundException
     */
    public static function updateModuleRecords($records, $form_id)
    {
        static::updateDependencies($records, $form_id);
        return parent::updateModuleRecords($records, $form_id);
    }


    /**
     * Retrieve all the key elements from C1, C2.2, C3.2 & C4
     *
     * @param $form_id
     * @return array
     */
    public static function valuesFromContext($form_id): array
    {
        $c1_values = collect(Designation::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Aspect')
            ->toArray();

        $c2_values = collect(SupportsAndConstraintsIntegration::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Stakeholder')
            ->toArray();

        $c3_values = collect(ThreatsIntegration::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Threat')
            ->toArray();

        $c4_values = collect(KeyElements::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Aspect')
            ->toArray();

        return array_merge($c1_values, $c2_values, $c3_values, $c4_values);
    }

}
