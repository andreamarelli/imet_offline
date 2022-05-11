<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class ResearchAndMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_research_and_monitoring';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR16';
        $this->module_title = trans('imet-core::v2_evaluation.ResearchAndMonitoring.title');
        $this->module_fields = [
            ['name' => 'Program',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ResearchAndMonitoring.fields.Program')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ResearchAndMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ResearchAndMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Program',
            'values' => trans('imet-core::v2_evaluation.ResearchAndMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ResearchAndMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ResearchAndMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ResearchAndMonitoring.ratingLegend');

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = static::replacePredefinedValue($record, 'Program',
         'Use of institutional capabilities and technical resources to initiate and coordinate research activities',
        'Institutional and/or external funds/facilities and capabilities to promote and coordinate research activities');
        $record = static::replacePredefinedValue($record, 'Program',
         'Utilisation des capacités institutionnelles et des ressources techniques pour lancer et coordonner les activités de recherche',
        'Fonds/installations et capacités institutionnels et/ou externes pour promouvoir et coordonner les activités de recherche');
        $record = static::replacePredefinedValue($record, 'Program',
         'Utilização das capacidades institucionais e dos recursos técnicos para iniciar e coordenar actividades de investigação',
        'Fundos/instalações e capacidades institucionais e/ou externas para promover e coordenar actividades de investigação');
        $record = static::replacePredefinedValue($record, 'Program',
         'Utilización de la capacidad institucional y los recursos técnicos para iniciar y coordinar actividades de investigación',
        'Fondos/instalaciones y capacidades institucionales y/o externas para promover y coordinar actividades de investigación');
        $record = static::replacePredefinedValue($record, 'Program',
         'Research and long-term ecological monitoring of terrestrial ecosystems and land use (land cover – land use – land take)',
        'Research and long-term ecological monitoring of habitats and related dimensions of land cover, land use, land take');
        $record = static::replacePredefinedValue($record, 'Program',
         'Recherche et surveillance écologique à long terme des écosystèmes et des habitats',
        'Recherche et surveillance écologique à long terme des habitats et les dimensions connexes de la couverture terrestre, utilisation et occupation des sols');
        $record = static::replacePredefinedValue($record, 'Program',
         'Investigação e monitorização ecológica a longo prazo dos ecossistemas terrestres e do uso da terra (cobertura do solo, uso e ocupação)',
        'Investigação e monitorização ecológica a longo prazo dos habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação');
        $record = static::replacePredefinedValue($record, 'Program',
         'Investigación y monitoreo ecológico/ambiental a largo plazo de los ecosistemas terrestres y el uso de la tierra (tenencia del territorio - uso del suelo - cobertura del suelo)',
        'Investigación y monitoreo ecológico/ambiental a largo plazo de los hábitats y las dimensiones relacionadas de la cobertura del suelo, uso del suelo y tenencia del territorio');
        $record = static::dropIfPredefinedValueObsolete($record, 'Program', 'Research and long-term ecological monitoring of marine ecosystems and habitats');
        $record = static::dropIfPredefinedValueObsolete($record, 'Program', 'Recherche et surveillance écologique à long terme de la couverture terrestre, utilisation et occupation des sols');
        $record = static::dropIfPredefinedValueObsolete($record, 'Program', 'Investigação e monitorização ecológica a longo prazo dos ecossistemas e habitats marinhos');
        $record = static::dropIfPredefinedValueObsolete($record, 'Program', 'Investigación y monitoreo ecológico/ambiental a largo plazo de los ecosistemas y hábitats marinos');

        return $record;
    }

}
