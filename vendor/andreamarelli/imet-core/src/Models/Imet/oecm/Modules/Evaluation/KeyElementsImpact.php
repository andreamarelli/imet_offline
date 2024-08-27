<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Support\Str;

class KeyElementsImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_key_elements_impact';
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
            ['name' => 'StatusSH',      'type' => 'rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.StatusSH')],
            ['name' => 'TrendSH',       'type' => 'rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.TrendSH')],
            ['name' => 'EffectSH',      'type' => 'disabled',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.EffectSH')],
            ['name' => 'ReliabilitySH', 'type' => 'dropdown-ImetOECM_Reliability',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.ReliabilitySH')],
            ['name' => 'CommentsSH',    'type' => 'text-area',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.CommentsSH')],
            ['name' => 'StatusER',      'type' => 'rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.StatusER')],
            ['name' => 'TrendER',       'type' => 'rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.KeyElementsImpact.fields.TrendER')],
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

    protected static function getPredefined($form_id = null): ?array
    {
        $predefined_values = $form_id!==null
            ? [
                'group0' => Modules\Context\AnimalSpecies::getReferenceList($form_id, 'species'),
                'group1' => Modules\Context\VegetalSpecies::getReferenceList($form_id, 'species'),
                'group2' => Modules\Context\Habitats::getReferenceList($form_id, 'EcosystemType')
            ]
            : [];

        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $predefined_values
        ];
    }
    
}
