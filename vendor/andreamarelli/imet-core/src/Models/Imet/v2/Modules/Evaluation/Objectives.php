<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Objectives extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_objectives';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P6';
        $this->module_title = trans('imet-core::v2_evaluation.Objectives.title');
        $this->module_fields = [
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.Objectives.fields.Objective')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.Objectives.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.Objectives.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Objective',
            'values' => trans('imet-core::v2_evaluation.Objectives.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.Objectives.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.Objectives.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.Objectives.ratingLegend');

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Ecosystem services – Provisioning (sustainable use)',
                                                 'Ecosystem services – Provisioning (food, seafood, materiel, water quality, etc. sustainable use)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Ecosystem services – Regulating (sustainable use)',
                                                 'Ecosystem services – Regulating (storm and coastal protection, water erosion, etc. sustainable use)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Ecosystem services – Cultural (sustainable use)',
                                                 'Ecosystem services – Cultural (tourism, traditional fishing, etc. sustainable use)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Ecosystem services – Supporting',
                                                 'Ecosystem services – Supporting (sea spawning grounds - nursery habitats, etc.)');

        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Services écosystémiques — Approvisionnement (utilisation durable)',
                                                 'Services écosystémiques — Approvisionnement (nourriture, produits de la mer, matériel, qualité de l\'eau, etc. utilisation durable)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Services écosystémiques - Régulation (utilisation durable)',
                                                 'Services écosystémiques - Régulation (protection contre les tempêtes et le littoral, érosion hydrique, etc. utilisation durable)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Services écosystémiques — Culturels (utilisation durable)',
                                                 'Services écosystémiques — Culturels (tourisme, pêche traditionnelle, etc. utilisation durable)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Services écosystémiques — Support / Soutien',
                                                 'Services écosystémiques — Support / Soutien (frayères marines - habitats de nourricerie, etc.)');


        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Serviços Ecossistémicos - Provisionamento (utilização sustentável)',
                                                 'Serviços Ecossistémicos - Provisionamento (alimentos, frutos do mar, material, qualidade da água, etc. utilização sustentável)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Serviços Ecossistémicos - Regulador (utilização sustentável)',
                                                 'Serviços Ecossistémicos - Regulador (proteção contra tempestades e costeiras, erosão hídrica, etc. utilização sustentável)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Serviços Ecossistémicos - Cultural (utilização sustentável)',
                                                 'Serviços Ecossistémicos - Cultural (turismo, pesca tradicional, etc. utilização sustentável)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Serviços Ecossistémicos - Apoio',
                                                 'Serviços Ecossistémicos - Apoio (zonas de desova no mar - habitats de berçário, etc.)');

        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Servicios y funciones ecosistémicas - Provisión (uso sostenible)',
                                                 'Servicios y funciones ecosistémicas - Provisión (alimentos, mariscos, material, calidad del agua, etc. uso sostenible)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Servicios y funciones ecosistémicas  - Regulación (uso sostenible)',
                                                 'Servicios y funciones ecosistémicas - Regulación (protección frente a tormentas y costas, erosión hídrica, etc.,uso sostenible)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Servicios y funciones ecosistémicas  - Cultural uso sostenible',
                                                 'Servicios y funciones ecosistémicas - Cultural (turismo, pesca tradicional, etc. uso sostenible)');
        $record = static::replacePredefinedValue($record, 'Objective',
                                                 'Servicios y funciones ecosistémicas  - Soporte',
                                                 'Servicios y funciones ecosistémicas - Soporte (zonas de desove en el mar - hábitats de cría, etc.)');




        return $record;
    }


}
