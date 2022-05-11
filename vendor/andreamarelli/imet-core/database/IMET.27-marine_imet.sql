BEGIN;

-- ##############################  CONTEXT  ##############################

-- GeneralInfo
ALTER TABLE imet.context_general_info ADD COLUMN IF NOT EXISTS "MarineDesignation" varchar(250);
UPDATE imet.context_general_info
    SET "Type" = 'terrestrial'
    WHERE "Type" = 'Terrestrial'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_general_info
    SET "Type" = 'marine_and_coastal'
    WHERE "Type" = 'Marine'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_general_info
    SET "Type" = 'marine_and_coastal'
    WHERE "Type" = 'Mixed'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_general_info
    SET "Type" = 'terrestrial'
    WHERE "Type" = 'Terrestre'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_general_info
    SET "Type" = 'marine_and_coastal'
    WHERE "Type" = 'Maritime'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_general_info
    SET "Type" = 'marine_and_coastal'
    WHERE "Type" = 'Mixte'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_general_info
    SET "Type" = 'terrestrial'
    WHERE "Type" = 'Terrestre'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_general_info
    SET "Type" = 'marine_and_coastal'
    WHERE "Type" = 'Marinho'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_general_info
    SET "Type" = 'marine_and_coastal'
    WHERE "Type" = 'Misturado'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');

-- Sectors
ALTER TABLE imet.context_sectors ADD COLUMN IF NOT EXISTS "TerrestrialOrMarine" varchar(50);

-- TerritorialReferenceContext
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN IF NOT EXISTS "SpillOverEvalPredatory0_500" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN IF NOT EXISTS "SpillOverEvalPredatory500_1000" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN IF NOT EXISTS "SpillOverEvalPredatory200_3000" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN IF NOT EXISTS "SpillOverEvalComposition0_500" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN IF NOT EXISTS "SpillOverEvalComposition500_1000" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN IF NOT EXISTS "SpillOverEvalComposition200_3000" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN IF NOT EXISTS "SpillOverEvalDistance0_500" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN IF NOT EXISTS "SpillOverEvalDistance500_1000" numeric;
ALTER TABLE imet.context_territorial_reference_context ADD COLUMN IF NOT EXISTS "SpillOverEvalDistance200_3000" numeric;

-- Habitats
INSERT INTO imet.context_habitats("FormID", "UpdateBy", "UpdateDate", "EcosystemType", "Value", "Area", "Comments")
SELECT "FormID", "UpdateBy", "UpdateDate",
       "HabitatType" as "EcosystemType",
       "Presence" as "Value",
       "Area",
       "Source" || '. ' || "Description" as "Comments"
FROM imet.context_habitats_marine
WHERE "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
DELETE FROM imet.context_habitats_marine WHERE "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
INSERT INTO imet.context_habitats("FormID", "UpdateBy", "UpdateDate", "EcosystemType", "Area", "DesiredConservationStatus", "Comments")
SELECT "FormID", "UpdateBy", "UpdateDate",
       "CoverType" as "EcosystemType",
       "HistoricalArea" as "Area",
       "ConservationStatusArea" as "DesiredConservationStatus",
       "Notes" as "Comments"
FROM imet.context_land_cover
WHERE "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
DELETE FROM imet.context_land_cover WHERE "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');

-- MenacesPressions
UPDATE imet.context_menaces_pressions
    SET "Value" = 'Increased rainfall and seasonal changes'
    WHERE "Value" = 'Other: Increased rainfall and seasonal changes'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_menaces_pressions
    SET "Value" = 'Aumento da precipitação e mudanças sazonais'
    WHERE "Value" = 'Other: Outros: Aumento da precipitação e mudanças sazonais'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_menaces_pressions
    SET "Value" = 'Aumento de las precipitaciones y cambios estacionales'
    WHERE "Value" = 'Otro: Aumento de las precipitaciones y cambios estacionales'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.context_menaces_pressions
    SET "Value" = 'Renewable abiotic energy use'
    WHERE "Value" = 'Renewable energies'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');

-- ##############################  EVALUATION  ##############################

--BoundaryLevel
UPDATE imet.eval_boundary_level_v2
    SET "Adequacy" = 'Clearly demarcated, unambiguous and therefore easily interpreted boundaries (e.g., signs, posts, markers, fences, buoys, etc.)'
    WHERE "Adequacy" = 'Boundaries marked by specific marks (e.g. buoys, signs, posts, beacons, fences, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_boundary_level_v2
    SET "Adequacy" = 'Limites clairement délimitées, non ambiguës et donc faciles à interpréter (p. ex. panneaux, poteaux, balises, clôtures, bouées, etc.)'
    WHERE "Adequacy" = 'Adéquation des limites marquées par des marques spécifiques (p. ex. panneaux, poteaux, balises, clôtures, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_boundary_level_v2
    SET "Adequacy" = 'Limites claramente demarcados, inequívocos e, portanto, facilmente interpretados (por exemplo, sinais, postes, marcadores, cercas, bóias, etc.)'
    WHERE "Adequacy" = 'Limites demarcados por marcas específicas (por exemplo, sinais, postes, balizas, vedações, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_boundary_level_v2
    SET "Adequacy" = 'Límites claramente demarcados, inequívocos y, por lo tanto, fáciles de interpretar (por ejemplo, señales, postes, marcadores, cercas, boyas, etc.)'
    WHERE "Adequacy" = 'Límites marcados por marcas específicas (por ejemplo, señales, postes, balizas, vallas, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_boundary_level_v2
    SET "Adequacy" = 'Collaboration approach including national agencies and relevant stakeholders in the demarcation of boundaries'
    WHERE "Adequacy" = 'Collaboration in the demarcation of boundaries'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_boundary_level_v2
    SET "Adequacy" = 'Approche de collaboration incluant les agences nationales et les parties prenantes concernées dans la démarcation des frontières'
    WHERE "Adequacy" = 'Collaboration des parties prenantes à la démarcation des frontières'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_boundary_level_v2
    SET "Adequacy" = 'Abordagem de colaboração, incluindo agências nacionais e partes interessadas relevantes na demarcação dos limites'
    WHERE "Adequacy" = 'Colaboração na demarcação dos limites'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_boundary_level_v2
    SET "Adequacy" = 'Enfoque de colaboración que incluye agencias nacionales y partes interesadas relevantes en la demarcación de fronteras'
    WHERE "Adequacy" = 'Colaboración en la demarcación de fronteras'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');


-- Objectives
UPDATE imet.eval_objectives
    SET "Objective" = 'Ecosystem services – Provisioning (food, seafood, materiel, water quality, etc. sustainable use)'
    WHERE "Objective" = 'Ecosystem services – Provisioning (sustainable use)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Ecosystem services – Regulating (storm and coastal protection, water erosion, etc. sustainable use)'
    WHERE "Objective" = 'Ecosystem services – Regulating (sustainable use)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Ecosystem services – Cultural (tourism, traditional fishing, etc. sustainable use)'
    WHERE "Objective" = 'Ecosystem services – Cultural (sustainable use)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Ecosystem services – Supporting (sea spawning grounds - nursery habitats, etc.)'
    WHERE "Objective" = 'Ecosystem services – Supporting'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Services écosystémiques — Approvisionnement (nourriture, produits de la mer, matériel, qualité de l''eau, etc. utilisation durable)'
    WHERE "Objective" = 'Services écosystémiques — Approvisionnement (utilisation durable)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Services écosystémiques - Régulation (protection contre les tempêtes et le littoral, érosion hydrique, etc. utilisation durable)'
    WHERE "Objective" = 'Services écosystémiques - Régulation (utilisation durable)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Services écosystémiques — Culturels (tourisme, pêche traditionnelle, etc. utilisation durable)'
    WHERE "Objective" = 'Services écosystémiques — Culturels (utilisation durable)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Services écosystémiques — Support / Soutien (frayères marines - habitats de nourricerie, etc.)'
    WHERE "Objective" = 'Services écosystémiques — Support / Soutien'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Serviços Ecossistémicos - Provisionamento (alimentos, frutos do mar, material, qualidade da água, etc. utilização sustentável)'
    WHERE "Objective" = 'Serviços Ecossistémicos - Provisionamento (utilização sustentável)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Serviços Ecossistémicos - Regulador (proteção contra tempestades e costeiras, erosão hídrica, etc. utilização sustentável)'
    WHERE "Objective" = 'Serviços Ecossistémicos - Regulador (utilização sustentável)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Serviços Ecossistémicos - Cultural (turismo, pesca tradicional, etc. utilização sustentável)'
    WHERE "Objective" = 'Serviços Ecossistémicos - Cultural (utilização sustentável)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Serviços Ecossistémicos - Apoio (zonas de desova no mar - habitats de berçário, etc.)'
    WHERE "Objective" = 'Serviços Ecossistémicos - Apoio'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Servicios y funciones ecosistémicas - Provisión (alimentos, mariscos, material, calidad del agua, etc. uso sostenible)'
    WHERE "Objective" = 'Servicios y funciones ecosistémicas - Provisión (uso sostenible)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Servicios y funciones ecosistémicas - Regulación (protección frente a tormentas y costas, erosión hídrica, etc.,uso sostenible)'
    WHERE "Objective" = 'Servicios y funciones ecosistémicas  - Regulación (uso sostenible)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Servicios y funciones ecosistémicas - Cultural (turismo, pesca tradicional, etc. uso sostenible)'
    WHERE "Objective" = 'Servicios y funciones ecosistémicas  - Cultural uso sostenible'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_objectives
    SET "Objective" = 'Servicios y funciones ecosistémicas - Soporte (zonas de desove en el mar - hábitats de cría, etc.)'
    WHERE "Objective" = 'Servicios y funciones ecosistémicas  - Soporte'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');

-- ManagementActivities
UPDATE imet.eval_management_activities
    SET group_key = 'group2' WHERE group_key = 'group3';

-- LawEnforcementImplementation
ALTER TABLE imet.eval_law_enforcement_implementation ADD COLUMN IF NOT EXISTS "group_key" varchar(50);
UPDATE imet.eval_law_enforcement_implementation
    SET group_key = 'group0'
    WHERE group_key IS NULL
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_law_enforcement_implementation
    SET "Element" = 'Non collaborative (technology: digital data, aerial monitoring, etc. Vs technology poor performance, qualified rangers)'
    WHERE "Element" = 'Non collaborative (technology: radar, optical-infrared, radio monitoring Vs technology poor performance, qualified rangers)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_law_enforcement_implementation
    SET "Element" = 'Não colaborativo (tecnologia: dados digitais, monitoramento aéreo, etc Vs mau desempenho, rangers fiscais qualificados)'
    WHERE "Element" = 'Não colaborativo (tecnologia: radar, infravermelho óptico, tecnologia de monitorização de rádio Vs mau desempenho, rangers fiscais qualificados)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_law_enforcement_implementation
    SET "Element" = 'No colaborativo (tecnología: datos digitales, vigilancia por aéreo, etc. vs. tecnología de bajo rendimiento, guardaparques calificados)'
    WHERE "Element" = 'No colaborativo (tecnología: radar, óptico-infrarrojo, vigilancia por radio vs. tecnología de bajo rendimiento, guardaparques calificados)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');

-- IntelligenceImplementation
UPDATE imet.eval_intelligence_implementation
    SET "group_key" = 'group2'
    WHERE "group_key" = 'group1'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_intelligence_implementation
    SET "Element" = 'Intelligence and investigations units orienting and supporting ranger patrols actions'
    WHERE "Element" = 'Intelligence and investigations units orienting ranger patrols actions '
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_intelligence_implementation
    SET "Element" = 'Unités de renseignement et d’enquête orientant et soutenant les actions des patrouilles de surveillants'
    WHERE "Element" = 'Unités de renseignement et d’enquête orientant les actions des patrouilles de surveillants'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_intelligence_implementation
    SET "Element" = 'Unidades de inteligência e investigação que orientam e apoiam as acções de patrulhamento dos fiscais'
    WHERE "Element" = 'Unidades de inteligência e investigação que orientam as acções de patrulhamento dos fiscais'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_intelligence_implementation
    SET "Element" = 'Las unidades de seguimiento de indicios y cruce de información orientan y apoyan las acciones de las patrullajes de los guardaparques'
    WHERE "Element" = 'Las unidades de seguimiento de indicios y cruce de información orientan las acciones de las patrullajes de los guardaparques'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');

-- AssistanceActivities
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Support for local activities (e.g. ecosystem services - provisioning management, climate change adaptation, etc.)'
    WHERE "Activity" = 'Support for local activities (e.g. ecosystem services management, climate change mitigation, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Soutien aux activités locales (gestion des services écosystémiques - gestion de l''approvisionnement, adaptation au changement climatique, etc.)'
    WHERE "Activity" = 'Soutien aux activités locales (gestion des services écosystémiques, atténuation du changement climatique, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Apoio a actividades locais (por exemplo, gestão de serviços ecossistémicos - gestão de aprovisionamento, adaptação às alterações climáticas, etc.)'
    WHERE "Activity" = 'Apoio a actividades locais (por exemplo, gestão de serviços ecossistémicos, mitigação das alterações climáticas, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Apoyo a las actividades locales (por ejemplo, gestión de los servicios/funciones ecosistémicas - gestión de aprovisionamiento, adaptación al cambio climático, etc.)'
    WHERE "Activity" = 'Apoyo a las actividades locales (por ejemplo, gestión de los servicios/funciones ecosistémicas, mitigación del cambio climático, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Purchase of agriculture products or seadfood for tourism and staff'
    WHERE "Activity" = 'Purchase of agriculture products for tourism and staff'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Compra de produtos agrícolas ou frutos do mar para turismo e pessoal'
    WHERE "Activity" = 'Compra de produtos agrícolas para turismo e pessoal'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Compra de productos agrícolas o del mar para el turismo y contratación de personal'
    WHERE "Activity" = 'Compra de productos agrícolas para el turismo y contratación de personal'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Minimisation of conflicts and strengthening of the sustainable management and use of ecosystem services (provisioning and cultural)'
    WHERE "Activity" = 'Minimisation of conflicts and strengthening of the sustainable management and use of ecosystem services'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Minimisation des conflits et renforcement de la gestion et de l’utilisation durables des services écosystémiques (approvisionnement et culture)'
    WHERE "Activity" = 'Minimisation des conflits et renforcement de la gestion et de l’utilisation durables des services écosystémiques'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Minimização dos conflitos e reforço da gestão e utilização sustentável dos serviços ecossistémicos (abastecimento e cultura)'
    WHERE "Activity" = 'Minimização dos conflitos e reforço da gestão e utilização sustentável dos serviços ecossistémicos'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_assistance_activities
    SET "Activity" = 'Reducción al mínimo de los conflictos y fortalecimiento de la gestión y el uso sostenible de los servicios/funciones ecosistémicas (avituallamiento y cultura)'
    WHERE "Activity" = 'Reducción al mínimo de los conflictos y fortalecimiento de la gestión y el uso sostenible de los servicios/funciones ecosistémicas'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');

-- NaturalResourcesMonitoring
UPDATE imet.eval_natural_resources_monitoring
    SET "Aspect" = 'Monitoring habitats and related dimensions of land cover, land use, land take'
    WHERE "Aspect" = 'Monitoring ecosystems and habitats'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_natural_resources_monitoring
    SET "Aspect" = 'Suivi des habitats et les dimensions connexes de couverture terrestre, utilisation et occupation des sols'
    WHERE "Aspect" = 'Suivi des écosystèmes et des habitats'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_natural_resources_monitoring
    SET "Aspect" = 'Monitorização de habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação'
    WHERE "Aspect" = 'Monitorização de ecossistemas e habitats'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_natural_resources_monitoring
    SET "Aspect" = 'Monitoreo de los hábitats y las dimensiones relacionadas de la cobertura del suelo, uso del suelo y tenencia del territorio'
    WHERE "Aspect" = 'Monitoreo de los ecosistemas y los hábitats'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
DELETE FROM imet.eval_natural_resources_monitoring WHERE "Aspect" = 'Monitoring land cover–land use–land take';
DELETE FROM imet.eval_natural_resources_monitoring WHERE "Aspect" = 'Suivi de la couverture terrestre, utilisation et occupation des sols';
DELETE FROM imet.eval_natural_resources_monitoring WHERE "Aspect" = 'Monitorização de terrenos (cobretura do solo, uso e ocupacão)';
DELETE FROM imet.eval_natural_resources_monitoring WHERE "Aspect" = 'Monitoreo de la cobertura del suelo  - uso del suelo - tenencia del territorio';

-- ResearchAndMonitoring
UPDATE imet.eval_research_and_monitoring
    SET "Program" = 'Institutional and/or external funds/facilities and capabilities to promote and coordinate research activities'
    WHERE "Program" = 'Use of institutional capabilities and technical resources to initiate and coordinate research activities'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_research_and_monitoring
    SET "Program" = 'Fonds/installations et capacités institutionnels et/ou externes pour promouvoir et coordonner les activités de recherche'
    WHERE "Program" = 'Utilisation des capacités institutionnelles et des ressources techniques pour lancer et coordonner les activités de recherche'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_research_and_monitoring
    SET "Program" = 'Fundos/instalações e capacidades institucionais e/ou externas para promover e coordenar actividades de investigação'
    WHERE "Program" = 'Utilização das capacidades institucionais e dos recursos técnicos para iniciar e coordenar actividades de investigação'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_research_and_monitoring
    SET "Program" = 'Fondos/instalaciones y capacidades institucionales y/o externas para promover y coordinar actividades de investigación'
    WHERE "Program" = 'Utilización de la capacidad institucional y los recursos técnicos para iniciar y coordinar actividades de investigación'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_research_and_monitoring
    SET "Program" = 'Research and long-term ecological monitoring of habitats and related dimensions of land cover, land use, land take'
    WHERE "Program" = 'Research and long-term ecological monitoring of terrestrial ecosystems and land use (land cover – land use – land take)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_research_and_monitoring
    SET "Program" = 'Recherche et surveillance écologique à long terme des habitats et les dimensions connexes de la couverture terrestre, utilisation et occupation des sols'
    WHERE "Program" = 'Recherche et surveillance écologique à long terme des écosystèmes et des habitats'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_research_and_monitoring
    SET "Program" = 'Investigação e monitorização ecológica a longo prazo dos habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação'
    WHERE "Program" = 'Investigação e monitorização ecológica a longo prazo dos ecossistemas terrestres e do uso da terra (cobertura do solo, uso e ocupação)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_research_and_monitoring
    SET "Program" = 'Investigación y monitoreo ecológico/ambiental a largo plazo de los hábitats y las dimensiones relacionadas de la cobertura del suelo, uso del suelo y tenencia del territorio'
    WHERE "Program" = 'Investigación y monitoreo ecológico/ambiental a largo plazo de los ecosistemas terrestres y el uso de la tierra (tenencia del territorio - uso del suelo - cobertura del suelo)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
DELETE FROM imet.eval_research_and_monitoring WHERE "Program" = 'Research and long-term ecological monitoring of marine ecosystems and habitats';
DELETE FROM imet.eval_research_and_monitoring WHERE "Program" = 'Recherche et surveillance écologique à long terme de la couverture terrestre, utilisation et occupation des sols';
DELETE FROM imet.eval_research_and_monitoring WHERE "Program" = 'Investigação e monitorização ecológica a longo prazo dos ecossistemas e habitats marinhos';
DELETE FROM imet.eval_research_and_monitoring WHERE "Program" = 'Investigación y monitoreo ecológico/ambiental a largo plazo de los ecosistemas y hábitats marinos';

-- ClimateChangeMonitoring
UPDATE imet.eval_climate_change_monitoring
    SET "Program" = 'Managing adaptation of habitats and the related dimensions of land cover – use – take in and outside of the protected area (avoid forest fragmentation, bare ground, etc.)'
    WHERE "Program" = 'Managing adaptation of habitats and the land cover – use – take in and outside of the protected area (avoid forest fragmentation, bare ground, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_climate_change_monitoring
    SET "Program" = 'Gestion de l’adaptation pour les habitats et les dimensions connexes de couverture terrestre, utilisation et occupation des sols à l’intérieur et à l’extérieur de l’aire protégée (éviter la fragmentation des forêts, les sols dénudés, etc.)'
    WHERE "Program" = 'Gestion de l’adaptation pour les habitats et le territoire (couverture terrestre, utilisation et occupation des sols à l’intérieur et à l’extérieur de l’aire protégée (éviter la fragmentation des forêts, les sols dénudés, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_climate_change_monitoring
    SET "Program" = 'Gestão da adaptação dos habitats e cobertura do solo, uso e ocupação dentro e fora da área protegida (evitar a fragmentação da floresta, solo descoberto, etc.)'
    WHERE "Program" = 'Gestão da adaptação dos habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação dentro e fora da área protegida (evitar a fragmentação da floresta, solo descoberto, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');
UPDATE imet.eval_climate_change_monitoring
    SET "Program" = 'Gestión de la adaptación de los hábitats y las dimensiones relacionadas de cobertura de suelos  -  uso del suelo  -  cobertura del suelo dentro y fuera del área protegida (evitar la fragmentación del bosque, el suelo desnudo, etc.)'
    WHERE "Program" = 'Gestión de la adaptación de los hábitats y la tenencia del territorio  -  uso del suelo  -  cobertura del suelo dentro y fuera del área protegida (evitar la fragmentación del bosque, el suelo desnudo, etc.)'
    AND "FormID" in (SELECT "FormID" from imet.imet_form WHERE version = 'v2');


-- AreaDominationMPA
CREATE TABLE IF NOT EXISTS imet.eval_area_domination_mpa
(
    id serial primary key,
    "FormID" integer
        constraint "FormID_fk"
            references imet.imet_form
            on update cascade on delete cascade,
    "UpdateBy"          integer,
    "UpdateDate"        varchar(30),
    "group_key"        varchar(50),
    "Activity"          text,
    "Patrol"            numeric,
    "RapidIntervention" numeric,
    "DetectionRemoteSensing"       boolean,
    "SpecialMeansRapidIntervention"            boolean
);

COMMIT;
