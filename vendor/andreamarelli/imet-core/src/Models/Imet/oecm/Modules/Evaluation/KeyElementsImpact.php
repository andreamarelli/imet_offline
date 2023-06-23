<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Support\Str;

class KeyElementsImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_key_elements_impact';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'KeyElement';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'O/C2';
        $this->module_title = trans('imet-core::oecm_evaluation.KeyElementsImpact.title');
        $this->module_fields = [
            ['name' => 'KeyElement',    'type' => 'disabled',      'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.KeyElement')],
            ['name' => 'StatusSH',      'type' => 'imet-core::rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.StatusSH')],
            ['name' => 'TrendSH',       'type' => 'imet-core::rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.TrendSH')],
            ['name' => 'EffectSH',      'type' => 'disabled',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.EffectSH')],
            ['name' => 'ReliabilitySH', 'type' => 'dropdown-ImetOECM_Reliability',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.ReliabilitySH')],
            ['name' => 'CommentsSH',    'type' => 'text-area',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.CommentsSH')],
            ['name' => 'StatusER',      'type' => 'imet-core::rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.StatusER')],
            ['name' => 'TrendER',       'type' => 'imet-core::rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.TrendER')],
            ['name' => 'EffectER',      'type' => 'disabled',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.EffectER')],
            ['name' => 'ReliabilityER', 'type' => 'dropdown-ImetOECM_Reliability',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.ReliabilityER')],
            ['name' => 'CommentsER',    'type' => 'text-area',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.CommentsER')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.KeyElementsImpact.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.KeyElementsImpact.groups.group1'),
            'group2' => trans('imet-core::oecm_evaluation.KeyElementsImpact.groups.group2'),
        ];

        $this->module_info_EvaluationQuestion   = trans('imet-core::oecm_evaluation.KeyElementsImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating               = trans('imet-core::oecm_evaluation.KeyElementsImpact.module_info_EvaluationQuestion');
        $this->ratingLegend                     = trans('imet-core::oecm_evaluation.KeyElementsImpact.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];
        $preLoaded = [
            'field' => 'KeyElement',
            'values' => [
                'group0' =>
                    Modules\Context\AnimalSpecies::getModule($form_id)
                        ->filter(function($item){
                            return !empty($item['species']);
                        })
                        ->pluck('species')
                        ->map(function($item){
                            return Str::contains($item, '|')
                                ? Animal::getScientificName($item)
                                : $item;
                        })
                        ->toArray(),
                'group1' =>
                    Modules\Context\VegetalSpecies::getModule($form_id)
                        ->filter(function($item){
                            return !empty($item['species']);
                        })
                        ->pluck('species')
                        ->toArray(),
                'group2' =>
                    Modules\Context\Habitats::getModule($form_id)
                        ->filter(function($item){
                            return !empty($item['EcosystemType']);
                        })
                        ->pluck('EcosystemType')
                        ->map(function($item){
                            $labels = SelectionList::getList('ImetOECM_Habitats');
                            return array_key_exists($item, $labels) ?
                                $labels[$item]
                                : null;
                        })
                        ->toArray()
            ]
        ];
        $module_records['records'] =  static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }
    
}
