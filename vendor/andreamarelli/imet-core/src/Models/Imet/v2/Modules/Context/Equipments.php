<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class Equipments extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_equipments';
//    protected $fixed_rows = true;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 3.3';
        $this->module_title = trans('imet-core::v2_context.Equipments.title');
        $this->module_fields = [
            ['name' => 'Resource',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Equipments.fields.Resource')],
            ['name' => 'AdequacyLevel',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::v2_context.Equipments.fields.AdequacyLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Equipments.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Resource',
            'values' => [
                'group0' => trans('imet-core::v2_context.Equipments.predefined_values.group0'),
                'group1' => trans('imet-core::v2_context.Equipments.predefined_values.group1'),
                'group2' => trans('imet-core::v2_context.Equipments.predefined_values.group2'),
                'group3' => trans('imet-core::v2_context.Equipments.predefined_values.group3'),
                'group4' => trans('imet-core::v2_context.Equipments.predefined_values.group4'),
                'group5' => trans('imet-core::v2_context.Equipments.predefined_values.group5'),
                'group6' => trans('imet-core::v2_context.Equipments.predefined_values.group6'),
                'group7' => trans('imet-core::v2_context.Equipments.predefined_values.group7'),
                'group8' => trans('imet-core::v2_context.Equipments.predefined_values.group8'),
                'group9' => trans('imet-core::v2_context.Equipments.predefined_values.group9'),
                'group10' =>trans('imet-core::v2_context.Equipments.predefined_values.group10'),
                'group11' =>trans('imet-core::v2_context.Equipments.predefined_values.group11'),
                'group12' =>trans('imet-core::v2_context.Equipments.predefined_values.group12')
            ]
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.Equipments.groups.group0'),
            'group1' => trans('imet-core::v2_context.Equipments.groups.group1'),
            'group2' => trans('imet-core::v2_context.Equipments.groups.group2'),
            'group3' => trans('imet-core::v2_context.Equipments.groups.group3'),
            'group4' => trans('imet-core::v2_context.Equipments.groups.group4'),
            'group5' => trans('imet-core::v2_context.Equipments.groups.group5'),
            'group6' => trans('imet-core::v2_context.Equipments.groups.group6'),
            'group7' => trans('imet-core::v2_context.Equipments.groups.group7'),
            'group8' => trans('imet-core::v2_context.Equipments.groups.group8'),
            'group9' => trans('imet-core::v2_context.Equipments.groups.group9'),
            'group10' => trans('imet-core::v2_context.Equipments.groups.group10'),
            'group11' => trans('imet-core::v2_context.Equipments.groups.group11'),
            'group12' => trans('imet-core::v2_context.Equipments.groups.group12'),
        ];

        $this->ratingLegend = trans('imet-core::v2_context.Equipments.ratingLegend');

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.0 -> v2.0b  ####
        $record = static::replacePredefinedValue($record, 'Resource', 'Hydraulic electric facility', 'Hydropower electric facility');

        return $record;
    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record = static::addField($record, 'Comments');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Scientific research', 'Scientific buildings');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Suitably equipped garage and workshop', 'Garage and workshop');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Dispensaries', 'Health care centre');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Other Buildings');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Officers and deputy officers', 'For officers and deputy officers');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Ranger Staff', 'For ranger Staff');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Support Staff', 'For support Staff');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Reception');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Other Buildings');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Hotels Tinga', 'Hotels (guest capacity)');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Eco-lodges camp nomade', 'Eco-lodges (guest capacity)');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Salamat', 'Encampments (guest capacity)');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Miradors', 'Viewpoints or Observation points');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Number of rooms');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Number of guides on service');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Horses');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Other means of anti-poaching equipments');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Other means of communication');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Other means of IT');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Water', 'Water supply');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Penetration roads/tracks into the protected area', 'Roads/tracks inside the protected area');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Penetration paths into the protected area', 'Paths inside the protected area');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Road for the outside', 'Road along the border');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Penetration waterways into the protected area', 'Waterways inside the protected area');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Other waterways');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Other airstrips');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Other transportation for the protected area');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Postes, barrières', 'Points de barrières');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Recherche scientifique', 'Bâtiments scientifique');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Garage aménagé et atelier', 'Garage et atelier');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Autres bâtiments');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Officiers et sous-officiers', 'pour Officiers et sous-officiers');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Agents', 'pour les Agents');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Personnel d\'appui', 'pour le Personnel d\'appui');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Personnel scientifique', 'pour le Personnel scientifique');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Accueil');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Hôtels', 'Hôtels (capacité d’accueil)');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Eco-lodges', 'Eco-lodges (capacité d’accueil)');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Miradors', 'Points de vue ou points d’observation (miradors)');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Guides en service');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'autre moyens');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Autre moyens');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Radar de controle', 'Radar de contrôle');
//        $record = static::replacePredefinedValue($record, 'Resource', 'GPS, boussoles', 'GPS, Boussoles');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Autre sources');
//        $record = static::dropIfPredefinedValueObsolete($record, 'Resource', 'Autre');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Sentiers de pénétration dans l\'aire protégée', 'Route de délimitation de l’aire protégée');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Voies fluviales de pénétration dans l\'aire protégée', 'Voies fluviales à l’intérieur de l’aire protégée');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Pistes aériennes à l\'intérieur et à l\'extérieur de l\'aire protégée', 'Pistes aériennes à l\'intérieur et/ou à l\'extérieur de l\'aire protégée');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Grandes voies de communication terrestres', 'Principales voies de communication terrestres');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Voies fluviales', 'Voies navigables intérieures et maritimes');
//        $record = static::replacePredefinedValue($record, 'Resource', 'Connexions aériennes nationales et internationales', 'Liaisons aériennes nationales et internationales de proximité');
//        return $record;
//    }

    public static function getAverages($form_id){
        $records = Equipments::getModuleRecords($form_id)['records'];

        $averages = [];
        foreach (array_keys((new Equipments())->module_groups) as $group){
            $sum = $count = 0;
            foreach ($records as $record){
                if($record['group_key'] === $group && $record['AdequacyLevel']!==null){
                    $sum += (integer) $record['AdequacyLevel'];
                    $count++;
                }
            }
            $averages[] = $count>0 ? round($sum/$count, 2) : 0;
        }
        return $averages;
    }
}
