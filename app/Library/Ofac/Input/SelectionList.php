<?php

namespace App\Library\Ofac\Input;

use App\Library\Utils\Type\DataArray;
use App\Models\Currency;
use Illuminate\Support\Facades\Session;


class SelectionList
{

    public static function getListType($type)
    {
        $list_type = preg_replace('/dropdown[\w]*-/', '', $type);
        $list_type = preg_replace('/suggestion[\w]*-/', '', $list_type);
        $list_type = preg_replace('/toggle[\w]*-/', '', $list_type);
        $list_type = preg_replace('/checkbox[\w]*-/', '', $list_type);
        $list_type = preg_replace('/selector[\w]*-/', '', $list_type);
        return $list_type;
    }

    /**
     * Get a list of "$type" elements.
     *
     * @param $type
     * @return array
     */
    public static function getList($type)
    {
        $type       = SelectionList::getListType($type);
        $list       = [];
        $create_url = null;

        if ($type == 'yes_no') {
            $list = [
                'true' => trans('common.yes'),
                'false' => trans('common.no')
            ];
        } elseif ($type == 'yes_no_text') {
            $list = [
                trans('common.yes'),
                trans('common.no')
            ];
        }

        // #######################################
        // ###########  KnowledgeBase  ###########
        // #######################################
        elseif ($type == 'Country') {
            $list = \App\Models\Country::selectionList();
        } elseif ($type == 'countryOFAC') {
            $list = \App\Models\Country::selectionList('PAIRS', \App\Models\Country::ofac()->get());
        } elseif ($type == 'countryOFACWithoutAWY') {
            $list = \App\Models\Country::selectionList('PAIRS', \App\Models\Country::ofac()->noAwy()->get());
        } elseif ($type == 'countryOFACwithALL') {
            $list        = \App\Models\Country::selectionList('PAIRS', \App\Models\Country::ofac()->get());
            $list['ALL'] = strtoupper(trans('entities.common.all_countries'));
        } elseif ($type == "ProtectedArea") {
            $list = \App\Models\ProtectedArea\ProtectedArea::selectionList();
        } elseif ($type == "ProtectedAreaWdpa") {
            $list = \App\Models\ProtectedArea\ProtectedArea::selectionWdpaList();
        } elseif ($type == "Concession") {
            $list = \App\Models\Concession\Concession::selectionList();
        } elseif ($type == "Landscape") {
            $list = \App\Models\Landscape::selectionList();
        } elseif ($type == "KeyLandscapeConservation") {
            $list = \App\Models\KeyLandscapeConservation::selectionList();
        } elseif ($type == "Regions") {
            $list = \App\Models\Regions::selectionList();
        } elseif ($type == "Continents") {
            $list = \App\Models\Continents::selectionList('FIELDS');
        } elseif ($type == "Institution") {
            $list = \App\Models\Institution\Institution::selectionList();
        } elseif ($type == "catalogue_keywords") {
            $list = \App\Models\Catalogue\Modules\Keywords::selectionList('ONLY_LABELS');
        } elseif ($type == "catalogue_authors") {
            $list = \App\Models\Catalogue\Modules\Author::selectionList('ONLY_LABELS');
        } elseif ($type == "InstitutionName") {
            $list = \App\Models\Institution\Institution::selectionList('ONLY_LABELS');
        } elseif ($type == "Currency") {
            $list = \App\Models\Currency::selectionList();
        } elseif ($type == "Project") {
            $list = \App\Models\Project\Project::selectionList_Project();
        } elseif ($type == "Program") {
            $list = \App\Models\Project\Project::selectionList_Program();
        } elseif ($type == "Training") {
            $list = \App\Models\Training\Training::selectionList();
        } elseif ($type == "Essence") {
            $list = \App\Models\Species\Plant::selectionList('ONLY_LABELS');
        } elseif ($type == "ForestType") {
            $list = \App\Models\ForestType::selectionList();
        } elseif ($type == "Taxe") {
            $list = \App\Models\Taxe::selectionList();
        } elseif ($type == "Permit") {
            $list = \App\Models\Permit::selectionList('ONLY_LABELS');
        } elseif ($type == "TypeProtectedArea") {
            $list = \App\Models\TypologyPa::selectionList('ONLY_LABELS');
        } elseif ($type == "Locality") {
            $list = \App\Models\Locality::selectionList('ONLY_LABELS');
        }

        // #####################################
        // #########  Protected Areas  #########
        // #####################################
        elseif ($type == "PA_iucn_categories") {
            $list = [
                'Ia' => 'Ia - Réserve Naturelle Intégrale',
                'Ib' => 'Ib - Zone de Nature sauvage',
                'II' => 'II - Parc national',
                'III' => 'III - Monument naturel ',
                'IV' => 'IV - Aire de gestion des habitats ou des espèces',
                'V' => 'V - Paysage terrestre ou marin protégé ',
                'VI' => 'VI - Aire Protégée de ressources naturelles gérée',
                'Not applicable' => 'Non applicable',
                'Not reported' => 'Non reporté',
            ];
        } elseif ($type == "PA_designation") {
            $list = array(
                'Domaine de Chasse',
                'Forêt Classifiée',
                'Forêt Communautaire',
                'Monument naturel',
                'Parc National',
                'Réserve',
                'Réserve Communautaire',
                'Réserve de Biosphère',
                'Réserve de Chasse',
                'Réserve de Faune',
                'Réserve des Gorilles',
                'Réserve Forestière',
                'Réserve Naturelle',
                'Réserve Naturelle Intégrale',
                'Réserve Présidentielle',
                'Réserve Scientifique',
                'Réserve Spéciale',
                'Sanctuaire',
                'Zone de Chasse',
                'Zone écologique'
            );
        } elseif ($type == "PA_status") {
            $list = array('Désigné', 'Proposé', 'Déclassé');
        }

        // #####################################
        // ###########  Concessions  ###########
        // #####################################
        elseif ($type == "PermitType") {
            $list = array(
                'CTI (Convention de Transformation Industrielle)',
                'CAT (Convention d\'Aménagement et de Transformation)',
                'CTIB (Convention de Transformation Industrielle du Bois)',
                'CEF (Convention d\'Exploitation Forestière)',
                'PS (Permis Spécial)',
                'GA (Garantie d\'approvisionnement)',
                'LI (Lettre d\'Intention)',
                'Fcom (Forêt Communautaire)',
                'Permis de coupe spécial',
                'PA (Permis de coupe artisanale',
                'CFAD (Concession Forestière sous Aménagement Durable)',
                'CPAET (Convention Provisoire d\'Aménagement-Exploitation-Transformation)',
                'PFA (Permis Forestier Associé)',
                'PGG (Permis de Gré à Gré)',
                'PI (Permis Industriel)',
                'PTE (Permis Temporaire d\'Exploitation)',
                'ZACF (Zone d\'Attraction du Chemin de Fer)',
                'Fcom (Forêt Communautaire)',
                'Concession Forestière'
            );
            sort($list);
        } elseif ($type == "AdvancementStatus") {
            $list = array(
                'Concession non attribuée',
                'Processus non initié',
                'Processus en cours',
                'Plan d\'aménagement agrée'
            );
            sort($list);
        } elseif ($type == "CertificationProcess") {
            $list = array(
                'FSC - Forest Management',
                'FSC - Controlled Wood',
                'FSC - Chain-of-Custody',
                'PEFC - Forest Management',
                'PEFC - Chain-of-Custody',
                'SCS - Independent',
                'FSC - Forest Management/Chain-of-Custody',
                'PEFC - Forest Management/Chain-of-Custody'
            );
            sort($list);
        } elseif ($type == "certificationProcessStatus") {
            $list = array('Phase d\'évaluation', 'Certification', 'Suspendu', 'Annulé ou non renouvelé');
            sort($list);
        } elseif ($type == "legalityProcess") {
            $list = array('TLTV (SGS)', 'OLB (BV)', 'VLO (SW)', 'VLC (SW)', 'Legal Harvest (SCS)');
            sort($list);
        } elseif ($type == "production") {
            $list = array('brut', 'net');
            sort($list);
        } elseif ($type == "PercentageRange") {
            $list = array('Moins de 5%', '5 à 10%', '10 à 25%', '25 à 50%', 'Plus de 50%');
        } elseif ($type == "popDensity") {
            $list = array(
                'Moins de 1 hab/km2',
                '1 à 5 hab/km2',
                '5 à 10 hab/km2',
                '10 à 20 hab/km2',
                'plus de 20 hab/km2'
            );
        } elseif ($type == "housing") {
            $list = array('base-vie', 'ville');
        } elseif ($type == "typeManager") {
            $list = array('Bureau d\'études', 'Ministère', 'Projet' ,'Cellule interne de l\'entreprise', 'Agence nationale');
        }
        // ####################################
        // ####### Transformation Plant #######
        // ####################################
        elseif ($type == "PlantType") {
            $list = array(
                'Déroulage',
                'Charpente Industrielle',
                'Contreplaqués',
                'Menuiserie Industrielle',
                'Moulurage',
                'Parquetterie',
                'Plaquage',
                'Sciage',
                'Sciage et deuxième transformation',
                'Sciérie',
                'Tranchage'
            );
            sort($list);
        }

        // ####################################
        // ##########  Institutions  ##########
        // ####################################
        elseif ($type == "LegalStatus") {
            $list = array(
                'Académique',
                'A.S.B.L./O.N.G.',
                'Confessionnel',
                'Indépendent',
                'Organisation internationale',
                'Privé',
                'Public'
            );
        }

        // #####################################
        // ##############  Staff  ##############
        // #####################################
        elseif ($type == 'role_ofac') {
            $list = [
                'Cellule régionale',
                'Membre du consortium',
                'Partenaire OFAC',
                'Partenaire PFBC',
                'Communauté scientifique',
                'Correspondant principal national OFAC',
                'Personne relais national OFAC',
                'Autre acteur national OFAC',
                'Correspondant principal local OFAC (Concession)',
                'Autre acteur local OFAC (Concession)',
                'Correspondant principal local OFAC (Placettes permanentes)',
                'Autre acteur local OFAC (Placettes permanentes)',
                'Correspondant principal local OFAC (Aire protégée)',
                'Autre acteur local OFAC (Aire protégée)',
                'Correspondant principal local OFAC (Unité de transformation)',
                'Autre acteur local OFAC (Unité de transformation)',
                'Correspondant principal local OFAC (Zone cynégétique)',
                'Autre acteur local OFAC (Zone cynégétique)'
            ];
        } elseif ($type == 'responsibilities_domain') {
            $list = [
                'pays' => 'Pays',
                'concession' => 'Concession',
                'transformation_plant' => 'Unités des transformation',
                'protected_area' => 'Aires protégées',
                'permanent_plots' => 'Placettes permanentes'
            ];
        } elseif ($type == 'responsibilities_role') {
            $list = [
                'Correspondant principal',
                'Responsable associé'
            ];
        } elseif ($type == 'permissions_indicators') {
            $list = ['S2', 'S5'];
        }

        // ######################################
        // #############  Catalogue  ############
        // ######################################
        elseif ($type === 'catalogue_document_type') {
            $list = [
                'image' => 'Image',
                'law' => 'Loi',
                'strategic_document' => 'Document stratégique',
                'map' => 'Carte',
                'photo' => 'Photo',
                'document' => 'Document',
                'publication' => 'Publication scientifique',
                'presentation' => 'Presentation',
                'dataset' => 'Tableur',
                'video' => 'Video',
                'other' => 'Autre'
            ];
        } elseif ($type == "catalogue_location") {
            $list = [
                'mondial' => 'Mondial',
                'continental' => 'Continental',
                'regional' => 'Régional',
                'national' => 'National',
                'ProtectedArea' => 'Aires protégées',
                'administrativeLevels' => 'Niveau sous-national',
                'Concession' => 'Concessions',
                'Landscape' => 'Paysages',
                'KeyLandscapeConservation' => ucfirst(trans('entities.klc'))
            ];
        } elseif ($type === 'catalogue_date_type') {
            $list = [
                'creation_date' => 'Date de creation',
                'publication_date' => 'Date de publication',
                'edition_date' => 'Date d\' édition',
            ];
        }

        // #####################################
        // #############  Projects  ############
        // #####################################
        elseif ($type == "type_of_initiative") {
            $list = [
                'PROJET' => 'Projet',
                'PROGRAMME' => 'Programme'
            ];
        } elseif ($type == "project_status") {
            $list = [
                'ongoing' => 'En cours',
                'finished' => 'Achevé',
//                'planned'  => 'Planifié'
            ];
        } elseif ($type == "ProjectBudgetType") {
            $list = [
                'Fonds privés',
                'Fonds publics',
                'Mixte'
            ];
        } elseif ($type == "ProjectBudgetInstrument") {
            $list = [
                'Dépenses budgétaires',
                'Dons',
                'Prêts',
                'Fonds propres',
                'Autre'
            ];
        } elseif ($type == "ProjectBudgetChannel") {
            $list = [
                'Institution internationale',
                'Ministères techniques',
                'Fonds nationaux',
                'Collectivités locales',
                'Etablissements publics nationaux',
                'Entreprises à capitaux publics',
                'Filières et fonds',
                'ONG/PTF',
                'Privés'
            ];
        } elseif ($type == "ProjectLocation") {
            $list = [
                'mondial' => 'Mondial',
                'continental' => 'Continental',
                'regional' => 'Régional',
                'national' => 'National',
                'ProtectedArea' => 'Aires protégées',
                'administrativeLevels' => 'Niveau sous-national',
                'Concession' => 'Concessions',
                'Landscape' => 'Paysages',
                'KeyLandscapeConservation' => ucfirst(trans('entities.klc'))
            ];
        } elseif ($type == 'convergence_plan_axes') {
            $list = [
                'ap_R1' => '<b>Axe prioritaire d\'intervention 1</b>: Harmonisation des politiques forestières et environnementales',
                'ap_R2' => '<b>Axe prioritaire d\'intervention 2</b>: Gestion et valorisation durable des ressources forestières',
                'ap_R3' => '<b>Axe prioritaire d\'intervention 3</b>: Conservation et utilisation durable de la diversité biologique',
                'ap_R4' => '<b>Axe prioritaire d\'intervention 4</b>: Lutte contre les effets du changement climatique et la désertification',
                'ap_R5' => '<b>Axe prioritaire d\'intervention 5</b>: Développement socio-économique et participation multi-acteurs',
                'ap_R6' => '<b>Axe prioritaire d\'intervention 6</b>: Financements durables',
                'at_R1' => '<b>Axe transversal 1</b>: Formation et renforcement des capacités',
                'at_R2' => '<b>Axe transversal 2</b>: Recherche-développement',
                'at_R3' => '<b>Axe transversal 3</b>: Communication, sensibilisation, information et éducation',
            ];
        } elseif ($type == "projectGeneralActivities") {
            $list = [
                'Appui technique',
                'Travaux de terrain',
                'Appui institutionnel',
                'Suivi-Evaluation/Audit/Etude d\'impact',
                'Formation/Communication',
                'Recherche',
                'Etude',
                'Autres'
            ];
        }


        // ####################################
        // #############  Expert  #############
        // ####################################
        elseif ($type == 'type_profil') {
            $list = array('Expert', 'Formateur');
        } elseif ($type == "diplome") {
            $list = array(
                'Bac',
                'Bac+2',
                'Bac+3',
                'Licence',
                'DEA',
                'DESS / Master II / Ingénieur',
                'Maîtrise / Master I',
                'PhD',
                'Doctorat',
                'Autre'
            );
        } elseif ($type == "expert_title") {
            $list = array('M.', 'Mme', 'Dr', 'Pr');
        } elseif ($type == "diplome") {
            $list = array(
                'Bac',
                'Bac+2',
                'Bac+3',
                'Licence',
                'DEA',
                'DESS / Master II / Ingénieur',
                'Maîtrise / Master I',
                'PhD',
                'Doctorat',
                'Autre'
            );
        } elseif ($type == "discipline_etude") {
            $list = array(
                'Agronomie',
                'Antropologie',
                'Biologie',
                'Communication',
                'Droit',
                'Economie',
                'Environnement',
                'Foresterie',
                'Géologie',
                'Géographie',
                'Management',
                'SIG / IT',
                'Sociologie',
                'Teledetection',
                'Autre'
            );
        } elseif ($type == "skills_level") {
            $list = array(
                'Débutant (0 - 2 ans)',
                'Intermédiaire (3 - 5 ans)',
                'Avancé (6 - 10 ans)',
                'Expert (+ de 10 ans)'
            );
        } elseif ($type == "languages") {
            $list = array(
                'Allemand',
                'Anglais',
                'Arabe',
                'Espagnol',
                'Français',
                'Italien',
                'Kikongo',
                'Kinyarwanda',
                'Kituba',
                'Lingala',
                'Portugais',
                'Russe',
                'Sango',
                'Swahili',
                'Tshiluba'
            );
        } elseif ($type == "lang_level") {
            $list = array('A1', 'A2', 'B1', 'B2', 'C1', 'C2');
        } elseif ($type == "software_cat") {
            $list = array(
                'SIG',
                'Base de données',
                'Graphisme',
                'Programmation',
                'Tableur',
                'Télédétection',
                'Traitement de textes'
            );
        } elseif ($type == "applications") {
            $list = array(
                'Adobe Illustrator',
                'Adobe Photoshop',
                'ArcGIS',
                'ArcInfo',
                'ArcView',
                'AutoCAD',
                'C',
                'C++',
                'ENVI',
                'Idrisi',
                'Ilwis',
                'Java',
                'JavaScript',
                'MapInfo',
                'MS Access',
                'MS Excel',
                'MS PowerPoint',
                'MS Publisher',
                'MS Word',
                'Office.Org',
                'PHP',
                'Python',
                'VB.NET',
                'VBA'
            );
        }


        // #####################################
        // ############  Trainings  ############
        // #####################################
        elseif ($type == "type_formation") {
            $list = array('Atelier', 'Séminaire', 'Stage');
        } elseif ($type == "training_domain") {
            $list = array_keys(\App\Models\Training\Training::$structure);
        }

        // ######################################
        // ##############   IMET   ##############
        // ######################################
        elseif (\Str::startsWith($type, 'ImetV1') || \Str::startsWith($type, 'ImetV2')) {
            preg_match("/Imet(V\d)\_([\w]+)/", $type, $matches);
            if ($matches[2] == "ProtectedArea") {
                $list = \App\Models\Imet\Utils\ProtectedArea::selectionList();
            } elseif ($matches[2] == "Currency") {
                $list = Currency::imetV1List();
            } else {
                $list = trans('form/imet/'.strtolower($matches[1]).'/lists.' . $matches[2]);
            }
        }

        // ###########################################
        // #########   National Indicators   #########
        // ###########################################
        elseif ($type == "applicationTextType") {
            $list = array('arrêté', 'circulaire', 'décision', 'décret', 'loi', 'ordonnance');
        } elseif ($type == "partiePrenante") {
            $list = array('Gouvernement', 'OSC', 'Communautés locales', 'ONG', 'autres');
        } elseif ($type == "niveau") {
            $list = array('Enseignement secondaire', 'Enseignement supérieur', 'Autre');
        } elseif ($type == "statut") {
            $list = array(
                'Intégralement protégé',
                'Partiellement protégé',
                'Vulnerable',
                'En voie de disparition',
                'En danger',
                'Critique',
                'Menacé',
                'Exploitation interdite',
                'Non protégé'
            );
        } elseif ($type == "category_iucn") {
            $list = array('I', 'Ia', 'Ib', 'II', 'III', 'IV', 'V', 'VI');
        } elseif ($type == "texteReglementaire") {
            $list = array(
                'Code du travail',
                'Code de Fonction Publique',
                'Convention Collective Forêt',
                'Convention Collective des métiers du bois, sciage, placage'
            );
            sort($list);
        } elseif ($type == "category_employed") {
            $list = array('Expatriés', 'Nationaux');
        } elseif ($type == "ofac_convention") {
            $list = array(
                'Protocole de Kyoto',
                'Accord International sur les Bois tropicaux',
                'APV/FLEGT',
                'CITES, Accord de Washington sur le commerce international des espèces de faune et de flore sauvages menacées dextinction',
                'Convention d\'Alger, Convention afriaine sur la conservation de la nature et des ressources naturelles',
                'Rio de janeiro,Convention Cadre des Nations Unies sur les Changements Climatiques',
                'Bonn, Convention sur la conservation des espèces migratoires appartenant à la faune sauvage',
                'Accord sur la conservation des oiseaux migrateurs d\'Afrique-Eurasie',
                'Convention de Ramsar',
                'Convention d\'Abidjan',
                'Convention de Maputo (Révision de la convention d\'Alger',
                'Traité de la COMIFAC (1999, Yaoundé)',
                'Traité de la COMIFAC (2005, Brazzaville)',
                'Genève,Convention sur la pêche et la conservation des ressources de la haute mer',
                'Convention des Nations-Unies sur la lutte contre la désertification',
                'Convention de Vienne sur la protection de la couche d\'ozone',
                'Accord de Coopération de la mise en place de la Tri-National de la Sangha(TNS)',
                'Accord sous-regional sur le contrôle forestier en Afrique Centrale',
                'Accord de Lusaka sur les opérations concertées de coercition visant le commerce illicite de la faune et de la flore sauvages',
                'Convention de Stockholm sur les Polluants Organiques Persistants (POPS)',
                'Convention de Rotterdam (PIC)',
                'Convention de Bâle sur le contrôle des mouvements transfrontières de déchets et leur élimination',
                'Convention de Bamako',
                'Rio, Convention sur la diversité biologique',
                'Protocole de Carthagène sur la biosécurité',
                'Protocole de Nagoya sur l\'accès et le partage des avantages (APA)',
                'Londres, Convention sur la prévention de la pollution des mers résultant e l\'immersion de déchets',
                'Convention sur l\'évaluation de l\'impact sur l\'environnement',
                'Convention concernant la protection de patrimoine mondial culturel et naturel (1972)',
                'Convention pour la sauvegarde du patrimoine culturel immateriel (2003)',
                'Union Mondiale pour la conservation de la nature et des ressources naturelles(UICN)',
                'Approhe stratégique de la gestion internationale des produits chimiques (SAICM)',
                'Convention 169 relative aux peuples indigènes et tribaux',
                'Convention phytosanitaire pour l\'Afrique',
                'Convention des Nations Unies sur le droit de la mer',
                'Convention sur la responsabilité civile des dommages résultant d\'activités dangereuses pour l\'environnement',
                'Convention internationale pour la protection des végétaux',
                'Protocole de Montréal relatif à des substances qui appauvrissent la couche d\'ozone',
                'Paris, Accord sur la conservation des gorilles et de leurs habitats (Accord Gorilla)'
            );
            sort($list);
        } elseif ($type == "etapes_REDD") {
            $list = array(
                'Adoption d’une méthodologie CLIP (Consentement Libre Informe et Préalable)',
                'Outil SESA est développé et disponibilité d’un Cadre de Gestion Environnementale et Social (CGES) dans le cadre de la REDD+',
                'Disponibilité d’une clé de répartition et fonctionnement du mécanisme de partage de bénéfices',
                'Disponibilité d’une analyse validée sur les facteurs directes et sous-jacents de Déforestation et de Dégradation Forestière',
                'Système National de Surveillance des Forêts définits, en place et fonctionnel',
                'Outils IEC (Information, Education et Communication) développés',
                'Procédures de Gestion de Conflits et de recours validées'
            );
        } elseif ($type == "certificat_gestion_durable") {
            $list = array(
                'FSC',
                'PEFC/PAFC',
                'ISO'
            );
            sort($list);
        } elseif ($type == "type_convention") {
            $list = array(
                'Convention',
                'Traité',
                'Accord',
                'Autre'
            );
//            sort($list);
        } elseif ($type == "certificat_legalite") {
            $list = array(
                'OLB',
                'TLTV',
                'VLC',
                'VLO',
                'FLEGT'
            );
            sort($list);
        } elseif ($type == "secteur") {
            $list = array(
                'Chasse',
                'Ecotourisme',
                'Genetique',
                'PFNL',
                'Pharmaceutique'
            );
        } elseif ($type == "NameProtectedArea") {
            $list  = \App\Models\ProtectedArea\ProtectedArea::selectionList();
            $list1 = array();
            foreach ($list as $key => $value) {
                $list1[$value] = $value;
            }
            $list = $list1;
        } elseif ($type == "domainsOfac") {
            $list = array(
                'Foncier',
                'Agriculture',
                'Agro-foncier',
                'Biodiversité',
                'Habitat',
                'Immobilier',
                'Tourisme',
                'Forêt',
                'Domanial',
                'Pétrolier',
                'Environnement',
                'Géologie',
                'Agricole',
                'Primatologie',
                'Sylviculture',
                'Culture',
                'Pêche',
                'Minier',
                'Domanial et foncier',
                'Elevage',
                'Procédure d\'expropriation',
                'Maritime',
                'Mer',
                'Statistique',
                'Eau',
                'Domaine de l\'état',
                'Chasse',
                'Aménagement forêt',
                'Conservation et promotion économique',
                'Exploitation des carrières',
                'Protection des végétaux',
                'Aquaculture',
                'Faune',
                'Bois',
                'Politique',
                'Gouvernance',
                'Protection de la nature',
                'Recherche',
                'Taxonomie',
                'Enseignement supérieur',
                'Production végetale',
                'Carrières',
                'Phytosanitaire',
                'Finance',
                'Comptabilité',
                'Agronomie',
                'Economie forestière',
                'Valorisation du bois',
                'Développement rural',
                'Agro-foresterie',
                'Enseignement technique',
                'Production animale',
                'Biotechnologie',
                'Foresterie',
                'Ressource naturelle',
                'Génie rural',
                'Botanique',
                'Biologie',
                'Menuiserie',
                'Agroforesterie',
                'Géographie',
                'Exploitation minière',
                'Exploitation forestière',
                'Production animale et végetale',
                'Botanique',
                'Ecologie',
                'Phytosociologie',
                'Sciences Sociales',
                'Hydraulique',
                'Ecologie forestière',
                'Hydrologie',
                'Ethnobotanique',
                'Cartographie',
                'Génie rural',
                'Limnologie',
                'Médecine traditionnelle',
                'Recherche médicale',
                'Pisciculture',
                'Sociologie',
                'Science et innovation',
                'Recherche scientifique',
                'Régime domanial et foncier',
                'Code domanial et foncier',
                'Droit coutumier',
                'Aménagement du territoire',
                'Explotación de canteras',
                'Ressource halieutique',
                'Ley de propiedad',
                'Droit de la propriété',
                'Ley Fundamental',
                'Biodiversidad',
                'Commerce',
                'Transport',
                'Santé',
                'Développement forestier',
                'Technologie',
                'Economie',
                'Droit',
                'Communication',
                'Antropologie',
                'Management',
                'Teledetection',
                'SIG / IT',
                'Autre',
                'Bétail',
                'Commercialisation et transport du bois',
                'Semences végetale et animale',
                'Education'
            );
            sort($list);
        } elseif ($type == "educationLevel") {
            $list = array('Universitaire (*)', 'Techniciens supérieurs', 'Techniciens', 'Autre');
        } elseif ($type == "typeExploitation") {
            $list = array('Artisanale', 'Industrielle', 'Semi-industrielle', 'Non précisée');
        } elseif ($type == "effort") {
            $list = array(
//                'Budget alloué par l\'Etat à la gestion des AP',
                'Personnel technique (niveau universitaire) affecté à la gestion des AP',
                'Personnel technique (niveau technicien) affecté par l\'administration à la gestion des AP',
                'Nombre d\'agents assermentés',
                'Effectif des éco-gardes',
                'Effectif des auxilliaires de conservation (gardes communautaires, villageois, etc.)',
                'Nombre d\'armes à disposition des AP',
                'Nombre de munitions allouées aux AP',
                'Personnel d\'appui (chauffeurs, mécaniciens, comptable, etc.)',
                'Ratio national d\'effectifs d\'éco-gardes par hectare',
                'Ratio de genre dans le personnel des AP',
                'Nombre d\'AP qui ont mis en oeuvre dans l\'année un suivi écologique',
                'Equipements disponibles dans les AP (véhicules, radio, chevaux, etc.)',
                'Infrastructures disponibles dans les AP (nombre de bâtiments, km de routes et de pistes)'
            );
        } elseif ($type == 'typeZica') {
            $list = array(
                'Bloc de chasse',
                'Domaine de chasse',
                'Domaine faunique communautaire (DFC)',
                'Réserve de Biosphère',
                'Secteur de chasse amodié',
                'Territoire de chasse communautaire',
                'Zone d\'intérêt cynégétique (ZIC)',
                'Zone d\'intérêt cynégétique à gestion communautaire (ZICGC)',
                'Zone cynégétique villageoise (ZCV)',
                'Zone de chasse amodiée'
            );
            sort($list);
        } elseif ($type == 'modeAttribution') {
            $list = array(
                'Adjudication',
                'Gré à gré',
                'Appel d’offre',
                'Décret',
                'Conversion d’un ancien titre',
                'Arrêté ministériel',
                'Vente aux enchères',
                'Comission d\'attribution'
            );
            sort($list);
        } elseif ($type == 'baseAttribution') {
            $list = array('Nombre de pieds', 'Superficie', 'Volume');
            sort($list);
        } elseif ($type == 'permisChasse') {
            $list = array(
                'Permis de Collecte',
                'Permis de Grande Chasse',
                'Permis de Guide de Chasse',
                'Permis de Petite Chasse',
                'Permis de Moyenne Chasse',
                'Permis spécial de détention d\'animaux vivants',
                'Permis CITES',
                'Permis de photogaphie tourisme',
                'Permis de chasse à la sauvagine',
                'Permis de recherche à but scientifique',
                'Permis de Capture',
                'Permis de chasse cinématographique',
                'Permis ordinaire de chasse',
                'Autres'
            );
            sort($list);
        }

        // If sequential array is given transpose to associative (same key/value)
        if (!is_string($list) && DataArray::isSequential($list)) {
            $list = array_combine($list, $list);
        }

        return $list;
    }

    /**
     * Return cached lists (retrieve and add if missing)
     *
     * @param $list_type
     * @return mixed
     */
    public static function CacheListInSession($list_type)
    {
        if (!Session::has('lists')) {
            Session::put('lists', []);
        }
        $cached_lists = Session::get('lists');
        if (!array_key_exists($list_type, $cached_lists)) {
            $cached_lists[$list_type] = static::getList($list_type);
            Session::forget('lists');
            Session::put('lists', $cached_lists);
        }
        return $cached_lists[$list_type];
    }

    public static function forceListInSession($list_type, $list)
    {
        if (!Session::has('lists')) {
            Session::put('lists', []);
        }
        $cached_lists             = Session::get('lists');
        $cached_lists[$list_type] = $list;
        Session::forget('lists');
        Session::put('lists', $cached_lists);
    }

    /**
     * Get a list of "$type" elements with only the given item
     *
     * @param $type
     * @param $value
     * @return array
     */
    public static function getItem($type, $value)
    {
        $list_type = SelectionList::getListType($type);
        return [$value => SelectionList::getLabel($list_type, $value)];
    }

    /**
     * Retrieve the label of the given list item
     *
     * @param $type
     * @param null $value
     * @return mixed|null
     */
    public static function getLabel($type, $value = null)
    {
        $list_type = SelectionList::getListType($type);
        $list      = SelectionList::getList($list_type);
        if ($value != null && array_key_exists($value, $list)) {
            return $list[$value];
        }
        return $value;
    }

    public static function toVueComponent($list)
    {
        if (is_string($list)) {
            $list = static::getList($list);
        }
        return htmlspecialchars(json_encode($list), ENT_QUOTES);
    }

}
