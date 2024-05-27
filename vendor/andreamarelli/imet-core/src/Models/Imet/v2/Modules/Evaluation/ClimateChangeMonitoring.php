<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ClimateChangeMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_climate_change_monitoring';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Program';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR17';
        $this->module_title = trans('imet-core::v2_evaluation.ClimateChangeMonitoring.title');
        $this->module_fields = [
            ['name' => 'Program',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ClimateChangeMonitoring.fields.Program')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ClimateChangeMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ClimateChangeMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Program',
            'values' => trans('imet-core::v2_evaluation.ClimateChangeMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ClimateChangeMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ClimateChangeMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ClimateChangeMonitoring.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Prefill from CTX
     */
    protected static function getPredefined($form_id = null): array
    {
        $predefined_values = $form_id !== null
            ? array_merge(
                trans('imet-core::v2_evaluation.ClimateChangeMonitoring.predefined_values'),
                Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray()
            )
            : [];

        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $predefined_values
        ];
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = static::replacePredefinedValue($record, 'Program',
         'Managing adaptation of habitats and the land cover – use – take in and outside of the protected area (avoid forest fragmentation, bare ground, etc.)',
        'Managing adaptation of habitats and the related dimensions of land cover – use – take in and outside of the protected area (avoid forest fragmentation, bare ground, etc.)');
        $record = static::replacePredefinedValue($record, 'Program',
        'Gestion de l’adaptation pour les habitats et le territoire (couverture terrestre, utilisation et occupation des sols à l’intérieur et à l’extérieur de l’aire protégée (éviter la fragmentation des forêts, les sols dénudés, etc.)',
        'Gestion de l’adaptation pour les habitats et les dimensions connexes de couverture terrestre, utilisation et occupation des sols à l’intérieur et à l’extérieur de l’aire protégée (éviter la fragmentation des forêts, les sols dénudés, etc.)');
        $record = static::replacePredefinedValue($record, 'Program',
         'Gestão da adaptação dos habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação dentro e fora da área protegida (evitar a fragmentação da floresta, solo descoberto, etc.)',
        'Gestão da adaptação dos habitats e cobertura do solo, uso e ocupação dentro e fora da área protegida (evitar a fragmentação da floresta, solo descoberto, etc.)');
        $record = static::replacePredefinedValue($record, 'Program',
         'Gestión de la adaptación de los hábitats y la tenencia del territorio  -  uso del suelo  -  cobertura del suelo dentro y fuera del área protegida (evitar la fragmentación del bosque, el suelo desnudo, etc.)',
        'Gestión de la adaptación de los hábitats y las dimensiones relacionadas de cobertura de suelos  -  uso del suelo  -  cobertura del suelo dentro y fuera del área protegida (evitar la fragmentación del bosque, el suelo desnudo, etc.)');

        return $record;
    }


}
