<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Exception;

class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'context_habitats';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\ThreatsBiodiversity::class, 'EcosystemType'],
        [Modules\Evaluation\KeyElementsImpact::class, 'EcosystemType'],
        [Modules\Evaluation\KeyElements::class, 'EcosystemType']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.3';
        $this->module_title = trans('imet-core::oecm_context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType', 'type' => 'dropdown-ImetOECM_Habitats',   'label' => trans('imet-core::oecm_context.Habitats.fields.EcosystemType')],
            ['name' => 'EcosystemDescription', 'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Habitats.fields.EcosystemDescription')],
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
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = static::getModule($form_id)
            ->pluck('EcosystemDescription', 'EcosystemType')
            ->unique()
            ->toArray();
        $updated_values = collect($records)
            ->pluck('EcosystemDescription', 'EcosystemType')
            ->unique()
            ->toArray();
        $to_be_dropped = array_diff($existing_values, $updated_values);

        // ### replace values with labels ###
        $labels =  SelectionList::getList('ImetOECM_Habitats');
        $to_be_dropped_new = [];
        foreach ($to_be_dropped as $type => $description){
            if(array_key_exists($type, $labels)){
                $to_be_dropped_new[] = empty($description)
                    ? $labels[$type]
                    : $labels[$type] . ' - ' .$description;
            }

        }

        return array_values($to_be_dropped_new);
    }

    /**
     * Override: replace values with habitat + description
     */
    public static function getReferenceList($form_id, $dependency_field): array
    {
        return static::getModule($form_id)
            ->filter(function ($item) {
                return !empty($item['EcosystemType']);
            })
            ->map(function ($item) {
                $labels = SelectionList::getList('ImetOECM_Habitats');
                $item['EcosystemType'] = array_key_exists($item['EcosystemType'], $labels) ?
                    $labels[$item['EcosystemType']]
                    : null;
                return empty($item['EcosystemDescription'])
                    ? $item['EcosystemType']
                    : $item['EcosystemType'] . ' - ' . $item['EcosystemDescription'];
            })
            ->toArray();
    }

}
