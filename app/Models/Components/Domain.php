<?php

namespace App\Models\Components;


trait Domain {

    private static $domain_relation_name = 'domains';

    public static $structure = [
        'Aménagement / Planification' => [
            'Aménagement',
            'Gestion durable',
            'Inventaire faunique',
            'Inventaire forestier',
            'Reboisement / Plantation',
            'Régénération',
            'Sylviculture'
        ],
        'Biodiversité / Conservation' => [
            'Aires protégées',
            'CBD et autres conventions',
            'Evaluation de la biodiversite',
            'Gestion de la biodiversité',
            'Gestion de la chasse',
            'Gestion de la faune sauvage',
            'Haute valeur de conservation',
            'Lutte anti-braconnage',
            'Réserves de biosphère','Suivi ecologique'
        ],
        'Changement climatique / REDD+' => [
            'Adaptation',
            'Approches inclusives',
            'Arrangement institutionnel REDD',
            'Attenuation',
            'Bilan carbone',
            'Carbone forestier',
            'Financement durable',
            'Mecanismes de Developpement Propre',
            'Monitoring Reporting Verification',
            'Negociations',
            'Peuple Autochtone et Communauté Locale',
            'Plan de Communication, sensibilisation et d\'engagement des PP',
            'Processus REDD (PIN, RPP, Stratégie nationale)',
            'Projets Pilotes REDD+',
            'SESA',
            'Système de surveillance de terre par satellite'
        ],
        'Ecologie forestière' => [
            'Agroécologie',
            'Botanique / systematique',
            'Changement Climatique',
            'Dynamique forestière',
            'Ecologie des espèces',
            'Formations végétales',
            'Interactions faune-flore',
            'Sciences du sol'
        ],
        'Économie / Législation / Gouvernance' => [
            'Certification',
            'Économie forestière',
            'FLEGT',
            'Législation forestière',
            'Participation de la société civile',
            'Poltique forestière',
            'Développement local'
        ],
        'Exploitation forestière' => [
            'Exploitation a impact reduit',
            'Génie forestier',
            'Normes et qualités',
            'Traçabilité'
        ],
        'Produits forestiers' => [
            'Bois d\'œuvre',
            'Bois énergie',
            'Carbonisation',
            'Exploitation artisanale',
            'Produits Forestiers Non Ligneux',
            'Transformation industrielle'
        ],
        'Protection forestière' => [
            'Dépérissement de forêt',
            'Incendie de forêt',
            'Réhabilitation des forêts',
            'Santé des forêts'
        ],
        'Services écosystémiques' => [
            'Agroforesterie',
            'Ecotourisme',
            'Forêt Communautaire',
            'Forêt sociale',
            'Paiement pour services environnementaux',
            'Produits Forestiers Non Ligneux',
            'Ressources hydriques',
            'Services culturels',
            'Services d\'approvisionnement',
            'Services de soutien',
            'Services régulés',
            'Viande de brousse',
            'Zones de chasse communautaire'
        ],
        'Systèmes d\'information forestiers' => [
            'Bases de données',
            'Cartographie forestière',
            'Dispositifs permanents',
            'Plateformes web, observatoires',
            'Statistiques forestières',
            'Systèmes d\'information geographique (SIG)',
            'Télédétection'
        ],
        'Autre' => [
            'Gouvernance',
            'Lutte contre la pauvrete',
            'Mines',
            'Agriculture']
    ];

//    const icons = [
//        'tasks',
//        'leaf',
//        'thermometer-three-quarters',
//        'tree',
//        'bank',
//        'map',
//        'industry',
//        'shield',
//        'cogs',
//        'info-circle',
//        'asterisk',
//    ];

    /**
     * Filters by domain using model's relation
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $domain
     * @param null $secondary_domain
     * @return mixed
     */
    public static function scopeWhereDomain($query, $domain, $secondary_domain = null)
    {
        return $query->whereHas(self::$domain_relation_name, function($inner_query) use ($domain, $secondary_domain){
            $inner_query->where('intervention_domain', $domain);
            if($secondary_domain!==null){
                $inner_query->where('secondaryDomain', $secondary_domain);
            }
        });
    }

    /**
     * Analytical Platform: filter by domain
     * @param $query
     * @param $domain
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeInAnalyticalPlatformDomain($query, $domain)
    {
        return $query->whereHas(self::$domain_relation_name, function($inner_query) use ($domain) {
            switch ($domain) {
                case 'forest_management':
                    $inner_query->whereIn('intervention_domain', [
                        'Exploitation forestière',
                        'Ecologie forestière',
                        'Produits forestiers',
                        'Protection forestière',
                        'Services écosystémiques',
                        'Systèmes d\'information forestiers'
                    ]);
                    break;
                case 'biodiversity':
                    $inner_query->whereIn('intervention_domain', [
                        'Biodiversité / Conservation',
                        'Protection forestière',
                        'Services écosystémiques'
                    ]);
                    break;
                case 'legal_framework':
                    $inner_query->whereIn('intervention_domain', [
                        'Aménagement / Planification',
                        'Économie / Législation / Gouvernance'
                    ]);
                    break;
                case 'climate_change':
                    $inner_query->whereIn('intervention_domain', [
                        'Changement climatique / REDD+',
                        'Services écosystémiques'
                    ]);
                    break;
            }
        });
    }

}

