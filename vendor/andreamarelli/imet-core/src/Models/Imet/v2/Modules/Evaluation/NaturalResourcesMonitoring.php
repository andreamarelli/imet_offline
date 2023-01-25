<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class NaturalResourcesMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_natural_resources_monitoring';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR15';
        $this->module_title = trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.NaturalResourcesMonitoring.ratingLegend');

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = static::replacePredefinedValue($record, 'Aspect',
         'Monitoring ecosystems and habitats',
         'Monitoring habitats and related dimensions of land cover, land use, land take');
        $record = static::replacePredefinedValue($record, 'Aspect',
         'Suivi des écosystèmes et des habitats',
         'Suivi des habitats et les dimensions connexes de couverture terrestre, utilisation et occupation des sols');
        $record = static::replacePredefinedValue($record, 'Aspect',
         'Monitorização de ecossistemas e habitats',
         'Monitorização de habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação');
        $record = static::replacePredefinedValue($record, 'Aspect',
         'Monitoreo de los ecosistemas y los hábitats',
         'Monitoreo de los hábitats y las dimensiones relacionadas de la cobertura del suelo, uso del suelo y tenencia del territorio');
        $record = static::dropIfPredefinedValueObsolete($record, 'Aspect', 'Monitoring land cover–land use–land take');
        $record = static::dropIfPredefinedValueObsolete($record, 'Aspect', 'Suivi de la couverture terrestre, utilisation et occupation des sols');
        $record = static::dropIfPredefinedValueObsolete($record, 'Aspect', 'Monitorização de terrenos (cobretura do solo, uso e ocupacão)');
        $record = static::dropIfPredefinedValueObsolete($record, 'Aspect', 'Monitoreo de la cobertura del suelo  - uso del suelo - tenencia del territorio');

        return $record;
    }

}
