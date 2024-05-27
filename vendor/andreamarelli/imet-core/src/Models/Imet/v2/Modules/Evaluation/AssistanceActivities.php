<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class AssistanceActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_assistance_activities';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR11';
        $this->module_title = trans('imet-core::v2_evaluation.AssistanceActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AssistanceActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.AssistanceActivities.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AssistanceActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.AssistanceActivities.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.AssistanceActivities.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.AssistanceActivities.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.AssistanceActivities.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AssistanceActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AssistanceActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AssistanceActivities.ratingLegend');

        parent::__construct($attributes);
    }

    public static function get_terrestrial_predefined(): array
    {
        $predefined = (new static())->predefined_values['values'];
        return [
            $predefined['group0'][17]
        ];
    }

    public static function get_marine_predefined(): array
    {
        $predefined = (new static())->predefined_values['values'];
        return [
            $predefined['group0'][18],
            $predefined['group0'][19],
            $predefined['group0'][20]
        ];
    }


    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Support for local activities (e.g. ecosystem services management, climate change mitigation, etc.)',
                 'Support for local activities (e.g. ecosystem services - provisioning management, climate change adaptation, etc.)');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Soutien aux activités locales (gestion des services écosystémiques, atténuation du changement climatique, etc.)',
                 'Soutien aux activités locales (gestion des services écosystémiques - gestion de l\'approvisionnement, adaptation au changement climatique, etc.)');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Apoio a actividades locais (por exemplo, gestão de serviços ecossistémicos, mitigação das alterações climáticas, etc.)',
                 'Apoio a actividades locais (por exemplo, gestão de serviços ecossistémicos - gestão de aprovisionamento, adaptação às alterações climáticas, etc.)');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Apoyo a las actividades locales (por ejemplo, gestión de los servicios/funciones ecosistémicas, mitigación del cambio climático, etc.)',
                 'Apoyo a las actividades locales (por ejemplo, gestión de los servicios/funciones ecosistémicas - gestión de aprovisionamiento, adaptación al cambio climático, etc.)');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Purchase of agriculture products for tourism and staff',
                 'Purchase of agriculture products or seadfood for tourism and staff');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Compra de produtos agrícolas para turismo e pessoal',
                 'Compra de produtos agrícolas ou frutos do mar para turismo e pessoal');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Compra de productos agrícolas para el turismo y contratación de personal',
                 'Compra de productos agrícolas o del mar para el turismo y contratación de personal');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Minimisation of conflicts and strengthening of the sustainable management and use of ecosystem services',
                 'Minimisation of conflicts and strengthening of the sustainable management and use of ecosystem services (provisioning and cultural)');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Minimisation des conflits et renforcement de la gestion et de l’utilisation durables des services écosystémiques',
                 'Minimisation des conflits et renforcement de la gestion et de l’utilisation durables des services écosystémiques (approvisionnement et culture)');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Minimização dos conflitos e reforço da gestão e utilização sustentável dos serviços ecossistémicos',
                 'Minimização dos conflitos e reforço da gestão e utilização sustentável dos serviços ecossistémicos (abastecimento e cultura)');
        $record = static::replacePredefinedValue($record, 'Activity',
                 'Reducción al mínimo de los conflictos y fortalecimiento de la gestión y el uso sostenible de los servicios/funciones ecosistémicas',
                 'Reducción al mínimo de los conflictos y fortalecimiento de la gestión y el uso sostenible de los servicios/funciones ecosistémicas (avituallamiento y cultura)');

        return $record;
    }


}
