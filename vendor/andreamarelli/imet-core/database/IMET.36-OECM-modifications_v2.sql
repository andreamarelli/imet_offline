BEGIN;

-- Governance
ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "SubGovernanceModel" character varying(250);
ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "MemberRepresentativenessLevel" integer;
ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "AdditionalInformation" text;

-- Areas
ALTER TABLE imet_oecm.context_areas ADD COLUMN IF NOT EXISTS "StrictConservationArea" numeric;

-- Habitats
ALTER TABLE imet_oecm.context_habitats ADD COLUMN IF NOT EXISTS "EcosystemDescription" text;

-- Stakeholders
ALTER TABLE imet_oecm.context_stakeholders_natural_resources DROP COLUMN IF EXISTS "Engagement";
ALTER TABLE imet_oecm.context_stakeholders_natural_resources DROP COLUMN IF EXISTS "Impact";
ALTER TABLE imet_oecm.context_stakeholders_natural_resources DROP COLUMN IF EXISTS "Role";
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "UsesCategories" text;
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "DirectUser" boolean;
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "LevelEngagement" numeric;
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "LevelInterest" numeric;
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "LevelExpertise" numeric;

-- StakeholdersObjectives
CREATE TABLE imet_oecm.context_stakeholders_objectives
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Status"     text,
    "ShortOrLongTerm" varchar(50),
    "Comments"   text,
    "Element"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

-- AnalysisStakeholder
CREATE TABLE imet_oecm.context_analysis_stakeholders_direct_users
(
    id               serial PRIMARY KEY,
    "FormID"         integer,
    "UpdateBy"       integer,
    "UpdateDate"     character varying(30),
    "Stakeholder"    text,
    "Element"        text,
    "Description"    text,
    "Dependence"     numeric,
    "Access"         character varying(50),
    "Rivalry"        boolean,
    "Quality"     numeric,
    "Quantity"     numeric,
    "Threats"       text,
    "Comments"       text,
    group_key        character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE TABLE imet_oecm.context_analysis_stakeholders_indirect_users
(
    id               serial PRIMARY KEY,
    "FormID"         integer,
    "UpdateBy"       integer,
    "UpdateDate"     character varying(30),
    "Stakeholder"    text,
    "Element"        text,
    "Description"    text,
    "Support"        numeric,
    "Guidelines"     character varying(100),
    "LackOfCollaboration"   boolean,
    "Status"         numeric,
    "Trend"          numeric,
    "Threats"        text,
    "Comments"       text,
    group_key        character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


-- AnalysisStakeholdersObjectives
CREATE TABLE imet_oecm.context_stakeholders_analysis_objectives
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Status"     text,
    "ShortOrLongTerm" varchar(50),
    "Comments"   text,
    "Element"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

-- ObjectivesContext
CREATE TABLE imet_oecm.eval_objectives_context
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Element"    text,
    "ShortOrLongTerm" varchar(50),
    "Objective"  text,
    "Comments"   text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE imet_oecm.eval_management_plan ADD COLUMN "PrintedCopy" boolean;
ALTER TABLE imet_oecm.eval_management_plan ADD COLUMN "ExplainedToMembers" boolean;
ALTER TABLE imet_oecm.eval_management_plan ADD COLUMN "KnowledgePercentage" numeric;

ALTER TABLE imet_oecm.eval_work_plan ADD COLUMN "PrintedCopy" boolean;
ALTER TABLE imet_oecm.eval_work_plan ADD COLUMN "ExplainedToMembers" boolean;
ALTER TABLE imet_oecm.eval_work_plan ADD COLUMN "KnowledgePercentage" numeric;

-- KeyElementsImpact
CREATE TABLE imet_oecm.eval_key_elements_impact
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "KeyElement"    text,
    "StatusSH"      numeric,
    "TrendSH"       numeric,
    "StatusER"      numeric,
    "TrendER"       numeric,
    "EffectSH"      numeric,
    "EffectER"      numeric,
    "ReliabilitySH" character varying(30),
    "ReliabilityER" character varying(30),
    "CommentsSH"    text,
    "CommentsER"    text,
    group_key        character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

COMMIT;
