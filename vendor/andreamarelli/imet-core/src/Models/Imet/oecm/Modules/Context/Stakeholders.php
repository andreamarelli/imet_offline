<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;

class Stakeholders extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_stakeholders_natural_resources';
    protected $fixed_rows = false;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Context\AnalysisStakeholderDirectUsers::class, 'Element'],
        [Modules\Context\AnalysisStakeholderIndirectUsers::class, 'Element'],
        [Modules\Evaluation\SupportsAndConstraints::class, 'Element'],
        [Modules\Evaluation\SupportsAndConstraintsIntegration::class, 'Element'],
        [Modules\Evaluation\CapacityAdequacy::class, 'Element'],
        [Modules\Evaluation\StaffCompetence::class, 'Element'],
        [Modules\Evaluation\StakeholderCooperation::class, 'Element'],
    ];

    public static $rules = [
        'Element' => 'required',
        'UsesCategories' => 'required_with:Element',
        'LevelEngagement' => 'required_unless:GeographicalProximity,true',
        'LevelInterest' => 'required_unless:GeographicalProximity,true',
        'LevelExpertise' => 'required_unless:GeographicalProximity,true'
    ];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'SA 1';
        $this->module_title = trans('imet-core::oecm_context.Stakeholders.title');
        $this->module_fields = [
            ['name' => 'Element',               'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'GeographicalProximity', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.GeographicalProximity')],
            ['name' => 'UsesCategories',        'type' => 'dropdown_multiple-ImetOECM_UsesCategories', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.UsesCategories')],
            ['name' => 'DirectUser',            'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.DirectUser')],
            ['name' => 'LevelEngagement',       'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.LevelEngagement')],
            ['name' => 'LevelInterest',         'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.LevelInterest')],
            ['name' => 'LevelExpertise',        'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.LevelExpertise')],
            ['name' => 'Comments',              'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Stakeholders.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_context.Stakeholders.groups');
        $this->module_info = trans('imet-core::oecm_context.Stakeholders.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.Stakeholders.ratingLegend');

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

        foreach ($records as $index => $record){
            // Ensure no "newline" (or other not allowed entities) are saved
            $record['Element'] = Str::replace("\n", '', $record['Element']);
            $record['Element'] = Str::replace("\r", '', $record['Element']);
            $record['Element'] = Str::replace("\t", '', $record['Element']);
            $record['Element'] = Str::replace("&nbsp;", '', $record['Element']);
            $record['Element'] = trim($record['Element']);
            // Remove all empty records: where "Element" is empty
            if($record['Element']===null || trim($record['Element'])===''){
                unset($records[$index]);
            }
        }
        return parent::updateModuleRecords($records, $form_id);
    }

    public const ALL_USERS = 0;
    public const ONLY_DIRECT = 1;
    public const ONLY_INDIRECT = 2;

    /**
     * Retrieve stakeholders' list (grouped or not)
     *
     * @param $form_id
     * @param int $mode
     * @param bool $with_categories
     * @return array
     */
    public static function getStakeholders($form_id, int $mode = self::ALL_USERS, bool $with_categories = false): array
    {
        $query = static::getModule($form_id);

        if($mode == static::ONLY_DIRECT){
            $query = $query->where('DirectUser', true);
        } else if($mode == static::ONLY_INDIRECT){
            $query = $query->where('DirectUser', '!=', true);
        }

        if($with_categories){
            $query = $query
                ->groupBy('Element')
                ->map(function ($group) {
                    $categories = [];
                    $group->map(function ($item) use (&$categories) {
                        if($item['UsesCategories'] !== null){
                            $categories = array_merge($categories, json_decode($item['UsesCategories']));
                        }
                    });
                    return json_encode($categories);
                });
        } else {
            $query = $query
                ->pluck('Element')
                ->unique();
        }

        return $query
            ->toArray();
    }

    /**
     * Retrieve stakeholders' wights
     *
     * @param $form_id
     * @param int $mode
     * @return array
     */
    public static function calculateWeights($form_id, int $mode = self::ALL_USERS): array
    {
        $query = static::getModule($form_id);

        if($mode == static::ONLY_DIRECT){
            $query = $query->where('DirectUser', true);
        } else if($mode == static::ONLY_INDIRECT){
            $query = $query->where('DirectUser', '!=', true);
        }

        $records = $query->toArray();

        return collect($records)
            ->filter(function($item){
                return !empty($item['Element']);
            })
            ->map(function($item){

                $UsesCategories = !empty($item['UsesCategories']) ? json_decode($item['UsesCategories']) : null;
                $UsesCategories = is_array($UsesCategories) ? count($UsesCategories) : null;

                $sum = $item['GeographicalProximity'] ? 4 : 0;
                $sum += $UsesCategories ?? 0; // max 5
                $sum += $item['DirectUser'] ? 7 : 0;
                $sum += $item['LevelEngagement']!==null ? $item['LevelEngagement'] : 0;
                $sum += $item['LevelInterest']!==null ? $item['LevelInterest'] : 0;
                $sum += $item['LevelExpertise']!==null ? $item['LevelExpertise'] : 0;

                $item['__weight'] = round($sum * 100 / 25, 0);

                $item['Element'] = Str::replace("\n", '', $item['Element']);

                return $item;
            })
            ->pluck('__weight', 'Element')
            ->toArray();
    }
}
