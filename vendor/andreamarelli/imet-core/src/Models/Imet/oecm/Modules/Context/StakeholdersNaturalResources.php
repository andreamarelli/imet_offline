<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class StakeholdersNaturalResources extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_stakeholders_natural_resources';
    protected $fixed_rows = false;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Context\AnalysisStakeholderAccessGovernance::class, 'Element'],
        [Modules\Context\AnalysisStakeholderTrendsThreats::class, 'Element'],
        [Modules\Evaluation\SupportsAndConstraints::class, 'Element'],
        [Modules\Evaluation\SupportsAndConstraintsIntegration::class, 'Element'],
        [Modules\Evaluation\CapacityAdequacy::class, 'Element'],
        [Modules\Evaluation\StaffCompetence::class, 'Element'],
        [Modules\Evaluation\StakeholderCooperation::class, 'Element'],
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 3.1.1';
        $this->module_title = trans('imet-core::oecm_context.StakeholdersNaturalResources.title');
        $this->module_fields = [
            ['name' => 'Element',                'type' => 'text-area', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'GeographicalProximity',  'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.GeographicalProximity')],
            ['name' => 'Engagement',             'type' => 'dropdown_multiple-ImetOECM_Engagement', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Engagement')],
            ['name' => 'Role',                   'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Role')],
            ['name' => 'Impact',                 'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Impact')],
            ['name' => 'Comments',               'type' => 'text-area', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_context.StakeholdersNaturalResources.groups');
        $this->ratingLegend = trans('imet-core::oecm_context.StakeholdersNaturalResources.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Remove all empty records: where "Element" is empty
     *
     * @param $records
     * @param $form_id
     * @return array|void
     * @throws FileNotFoundException
     */
    public static function updateModuleRecords($records, $form_id)
    {
        // Remove all empty records: where "Element" is empty
        foreach ($records as $index => $record){
            if($record['Element']===null || trim($record['Element'])===''){
                unset($records[$index]);
            }
        }
        return parent::updateModuleRecords($records, $form_id);
    }

    /**
     * Retrieve stakeholders' list (grouped or not)
     *
     * @param $form_id
     * @param bool $grouped
     * @return array
     */
    public static function getStakeholders($form_id, bool $grouped = false): array
    {
        if($grouped){
            return static::getModule($form_id)
                ->groupBy('group_key')
                ->map(function($group){
                    return $group->pluck('Element');
                })
                ->toArray();
        } else {
            return static::getModule($form_id)
                ->pluck('Element')
                ->unique()
                ->toArray();
        }
    }

    /**
     * Retrieve stakeholders' wights
     *
     * @param $form_id
     * @return array
     */
    public static function calculateWeights($form_id): array
    {
        $records = static::getModuleRecords($form_id)['records'];

        return collect($records)
            ->map(function($item){
                $Engagement = !empty($item['Engagement']) ? json_decode($item['Engagement']) : null;
                $Engagement = is_array($Engagement) ? count($Engagement) : null;

                $sum = $item['Impact']!==null ? $item['Impact'] : 0;
                $sum += $item['Role']!==null ? $item['Role'] : 0;
                $sum += $Engagement ?? 0;
                $sum += $item['GeographicalProximity'] ? 4 : 0;

                $item['__weight'] = round($sum * 100 / 16, 0);

                return $item;
            })
            ->pluck('__weight', 'Element')
            ->toArray();
    }
}
