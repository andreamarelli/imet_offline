<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Exception;

class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_habitats';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [AnalysisStakeholderAccessGovernance::class, 'species', 'Element']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.3';
        $this->module_title = trans('imet-core::oecm_context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType',             'type' => 'dropdown-ImetOECM_Habitats',   'label' => trans('imet-core::oecm_context.Habitats.fields.EcosystemType')],
            ['name' => 'ExploitedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Habitats.fields.ExploitedSpecies')],
            ['name' => 'ProtectedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Habitats.fields.ProtectedSpecies')],
            ['name' => 'DisappearingSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Habitats.fields.DisappearingSpecies')],
            ['name' => 'PopulationEstimation', 'type' => 'dropdown-ImetOECM_PopulationStatus', 'label' => trans('imet-core::oecm_context.Habitats.fields.PopulationEstimation')],
            ['name' => 'DescribeEstimation', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Habitats.fields.DescribeEstimation')],
            ['name' => 'Comments', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Habitats.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::oecm_context.Habitats.module_info');

        parent::__construct($attributes);
    }


    /**
     * Override: replace values with labels
     * @param $records
     * @param $form_id
     * @param $dependency_on
     * @return array
     * @throws Exception
     */
    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        $to_be_dropped = parent::getRecordsToBeDropped($records, $form_id, $dependency_on);

        // ### replace values with labels ###
        $labels =  SelectionList::getList('ImetOECM_Habitats');
        foreach ($to_be_dropped as $index => $item){
            if(array_key_exists($item, $labels)){
                $to_be_dropped[$index] = $labels[$item];
            }
        }

        return array_values($to_be_dropped);
    }
}
