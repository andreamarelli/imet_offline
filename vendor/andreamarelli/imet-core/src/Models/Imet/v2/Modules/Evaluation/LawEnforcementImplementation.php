<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class LawEnforcementImplementation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_law_enforcement_implementation';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR8';
        $this->module_title = trans('imet-core::v2_evaluation.LawEnforcementImplementation.title');
        $this->module_fields = [
            ['name' => 'Element',   'type' => 'text-area',          'label' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'Adequacy',  'type' => 'imet-core::rating-0to3WithNA',  'label' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.fields.Adequacy')],
            ['name' => 'Comments',  'type' => 'text-area',               'label' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.LawEnforcementImplementation.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.LawEnforcementImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.LawEnforcementImplementation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.LawEnforcementImplementation.ratingLegend');

        parent::__construct($attributes);
    }

    public static function get_terrestrial_groups(): array
    {
        $groups = (new static())->module_groups;
        return [
            $groups['group0']
        ];
    }

    public static function get_marine_groups(): array
    {
        $groups = (new static())->module_groups;
        return [
            $groups['group1']
        ];
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        if(empty($imet_version) or $imet_version < 'v2.7.6b'){
            // add new "group_key" filed and set to "group0"
            $record = static::addField($record, 'group_key');
            $record = static::replaceGroup($record, 'group_key', null, 'group0');
        }

        $record = static::replacePredefinedValue($record, 'Element',
                                                 'Non collaborative (technology: radar, optical-infrared, radio monitoring Vs technology poor performance, qualified rangers)',
                                                 'Non collaborative (technology: digital data, aerial monitoring, etc. Vs technology poor performance, qualified rangers)');
        $record = static::replacePredefinedValue($record, 'Element',
                                                 'Não colaborativo (tecnologia: radar, infravermelho óptico, tecnologia de monitorização de rádio Vs mau desempenho, rangers fiscais qualificados)',
                                                 'Não colaborativo (tecnologia: dados digitais, monitoramento aéreo, etc Vs mau desempenho, rangers fiscais qualificados)');
        $record = static::replacePredefinedValue($record, 'Element',
                                                 'No colaborativo (tecnología: radar, óptico-infrarrojo, vigilancia por radio vs. tecnología de bajo rendimiento, guardaparques calificados)',
                                                 'No colaborativo (tecnología: datos digitales, vigilancia por aéreo, etc. vs. tecnología de bajo rendimiento, guardaparques calificados)');

        return $record;
    }
}
