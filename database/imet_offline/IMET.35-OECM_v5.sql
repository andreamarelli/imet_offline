BEGIN;

DROP SCHEMA IF EXISTS imet_oecm CASCADE;

CREATE SCHEMA imet_oecm;

-- ### Form tables ##

CREATE TABLE imet_oecm.imet_form
(
    "FormID"     serial PRIMARY KEY,
    "Year"       integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "language"   character(2),
    version      character(4),
    "Country"    character(3),
    validation   character varying(25),
    wdpa_id      integer,
    name         text
);

CREATE TABLE imet_oecm.imet_encoders
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    first_name   character varying,
    last_name    character varying,
    organisation character varying,
    function     character varying,
    "UpdateDate" character varying(30),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

-- ##########################################
-- ######  Modules' tables  - CONTEXT  ######
-- ##########################################

CREATE TABLE imet_oecm.context_encoding_responsables_interviewees
(
    id                 serial PRIMARY KEY,
    "FormID"           integer,
    "UpdateBy"         integer,
    "UpdateDate"       character varying(30),
    "Name"             text,
    "Institution"      text,
    "Function"         text,
    "Contacts"         text,
    "EncodingDate"     character varying(30),
    "EncodingDuration" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_encoding_responsables_interviewers
(
    id                 serial PRIMARY KEY,
    "FormID"           integer,
    "UpdateBy"         integer,
    "UpdateDate"       character varying(30),
    "Name"             text,
    "Institution"      text,
    "Function"         text,
    "Contacts"         text,
    "EncodingDate"     character varying(30),
    "EncodingDuration" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_governance
(
    id                          serial PRIMARY KEY,
    "FormID"                    integer,
    "UpdateBy"                  integer,
    "UpdateDate"                character varying(30),
    "GovernanceModel"           character varying(250),
    "AdditionalInfo"            text,
    "ManagementUnique"          character varying(125),
    "ManagementName"            text,
    "ManagementList"            text,
    "ManagementType"            character varying(250),
    "DateOfCreation"            character varying(125),
    "OfficialRecognition"       boolean,
    "SupervisoryInstitution"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_general_info
(
    id                 serial PRIMARY KEY,
    "FormID"           integer,
    "UpdateBy"         integer,
    "UpdateDate"       character varying(30),
    "CompleteName"     text,
    "UsedName"         text,
    "CompleteNameWDPA" text,
    "WDPA"             integer,
    "Type"             character varying(35),
    "Country"          character(3),
    "CreationYear"     integer,
    "ReferenceText"    text,
    "Ownership"        character varying(350),
    "Importance"       text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_special_status
(
    id                    serial PRIMARY KEY,
    "FormID"              integer,
    "UpdateBy"            integer,
    "UpdateDate"          character varying(30),
    "Designation"         character varying(250),
    "RegistrationDate"    character varying(30),
    "DesignationCriteria" text,
    "Code"                character varying(250),
    "Area"                numeric,
    upload                character varying(256),
    "upload_BYTEA"        bytea,
    group_key             character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_networks
(
    id               serial PRIMARY KEY,
    "FormID"         integer,
    "UpdateBy"       integer,
    "UpdateDate"     character varying(30),
    "NetworkName"    text,
    "ProtectedAreas" text,
    group_key        character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_missions
(
    id               serial PRIMARY KEY,
    "FormID"         integer,
    "UpdateBy"       integer,
    "UpdateDate"     character varying(30),
    "LocalVision"    text,
    "LocalMission"   text,
    "LocalObjective" text,
    "LocalSource"    text,
    "Observation"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_contexts
(
    id             serial PRIMARY KEY,
    "FormID"       integer,
    "UpdateBy"     integer,
    "UpdateDate"   character varying(30),
    "Context"      text,
    file           text,
    "file_BYTEA"   bytea,
    "Summary"      text,
    "Observations" text,
    "Source"       text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_objectives1
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

CREATE TABLE imet_oecm.context_objectives2
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

CREATE TABLE imet_oecm.context_objectives3
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

CREATE TABLE imet_oecm.context_objectives4
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

CREATE TABLE imet_oecm.context_objectives5
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

CREATE TABLE imet_oecm.context_objectives6
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

CREATE TABLE imet_oecm.context_localization
(
    id                       serial PRIMARY KEY,
    "FormID"                 integer,
    "UpdateBy"               integer,
    "UpdateDate"             character varying(30),
    "LimitsExist"            boolean,
    "Shapefile"              character varying(255),
    "Shapefile_BYTEA"        bytea,
    "SourceSHP"              text,
    "Coordinates"            text,
    "SourceCoords"           text,
    "AdministrativeLocation" text,
    "Observations"           text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_areas
(
    id                   serial PRIMARY KEY,
    "FormID"             integer,
    "UpdateBy"           integer,
    "UpdateDate"         character varying(30),
    "AdministrativeArea" numeric,
    "WDPAArea"           numeric,
    "GISArea"            numeric,
    "TerrestrialArea"    numeric,
    "MarineArea"         numeric,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_management_staff
(
    id               serial PRIMARY KEY,
    "FormID"         integer,
    "UpdateBy"       integer,
    "UpdateDate"     character varying(30),
    "Function"       text,
    "Number"         numeric,
    "Male"           text,
    "Female"         text,
    "Descriptions"   text,
    "AdequateNumber" integer,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_management_staff_partners
(
    id             serial PRIMARY KEY,
    "FormID"       integer,
    "UpdateBy"     integer,
    "UpdateDate"   character varying(30),
    "Partner"      text,
    "Coordinators" numeric,
    "Technicians"  numeric,
    "Auxiliaries"  numeric,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE imet_oecm.context_management_relative_importance
(
    id             serial PRIMARY KEY,
    "FormID"       integer,
    "UpdateBy"     integer,
    "UpdateDate"   character varying(30),
    "RelativeImportance"  numeric,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_financial_resources
(
    id                           serial PRIMARY KEY,
    "FormID"                     integer,
    "UpdateBy"                   integer,
    "UpdateDate"                 character varying(30),
    "Currency"                   character(3),
    "TotalAnnualBudgetAvailable" numeric,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_equipments
(
    id              serial PRIMARY KEY,
    "FormID"        integer,
    "UpdateBy"      integer,
    "UpdateDate"    character varying(30),
    "Resource"      character varying(250),
    "AdequacyLevel" numeric,
    "Comments"      text,
    group_key       character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_species_animal_presence
(
    id                     serial PRIMARY KEY,
    "FormID"               integer,
    "UpdateBy"             integer,
    "UpdateDate"           character varying(30),
    "SpeciesID"            integer,
    "ExploitedSpecies"     boolean,
    "ProtectedSpecies"     boolean,
    "DisappearingSpecies"  boolean,
    "InvasiveSpecies"      boolean,
    "PopulationEstimation" varchar(50),
    "DescribeEstimation"   text,
    "Comments"             text,
    species                character varying(250),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_species_vegetal_presence
(
    id                     serial PRIMARY KEY,
    "FormID"               integer,
    "UpdateBy"             integer,
    "UpdateDate"           character varying(30),
    "SpeciesID"            integer,
    "ExploitedSpecies"     boolean,
    "ProtectedSpecies"     boolean,
    "DisappearingSpecies"  boolean,
    "InvasiveSpecies"      boolean,
    "PopulationEstimation" varchar(50),
    "DescribeEstimation"   text,
    "Comments"             text,
    species                character varying(250),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_habitats
(
    id                     serial PRIMARY KEY,
    "FormID"               integer,
    "UpdateBy"             integer,
    "UpdateDate"           character varying(30),
    "EcosystemType"        text,
    "ExploitedSpecies"     boolean,
    "ProtectedSpecies"     boolean,
    "DisappearingSpecies"  boolean,
    "PopulationEstimation" varchar(50),
    "DescribeEstimation"   text,
    "Comments"             text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE imet_oecm.context_stakeholders_natural_resources
(
    id                      serial PRIMARY KEY,
    "FormID"                integer,
    "UpdateBy"              integer,
    "UpdateDate"            character varying(30),
    "Element"               text,
    "GeographicalProximity" boolean,
    "Engagement"            text,
    "Impact"                numeric,
    "Role"                  numeric,
    "Comments"              text,
    group_key               character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_analysis_stakeholders_access_governance
(
    id               serial PRIMARY KEY,
    "FormID"         integer,
    "UpdateBy"       integer,
    "UpdateDate"     character varying(30),
    "Stakeholder"    text,
    "Element"        text,
    "Dependence"     numeric,
    "Access"         character varying(50),
    "Rivalry"        boolean,
    "Involvement"    boolean,
    "Accountability" boolean,
    "Orientation"    boolean,
    "Comments"       text,
    group_key        character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_analysis_stakeholders_trends_threats
(
    id                    serial PRIMARY KEY,
    "FormID"              integer,
    "UpdateBy"            integer,
    "UpdateDate"          character varying(30),
    "Stakeholder"         text,
    "Element"             text,
    "Status"              numeric,
    "Trend"               numeric,
    "MainThreat"          text,
    "ClimateChangeEffect" numeric,
    "Comments"            text,
    group_key             character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


-- #############################################
-- ######  Modules' tables  - EVALUATION  ######
-- #############################################

CREATE TABLE imet_oecm.designation
(
    id                            serial PRIMARY KEY,
    "FormID"                      integer,
    "UpdateBy"                    integer,
    "UpdateDate"                  character varying(30),
    "Aspect"                      text,
    "EvaluationScore"             numeric,
    "Comments"                    text,
    "SignificativeClassification" boolean,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_key_elements
(
    id                    serial PRIMARY KEY,
    "FormID"              integer,
    "UpdateBy"            integer,
    "UpdateDate"          character varying(30),
    "Aspect"              text,
    "Importance"          numeric,
    "EvaluationScore"     numeric,
    "IncludeInStatistics" boolean,
    "Comments"            text,
    group_key             character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_objectives_key_elements
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Element"    text,
    "Status"     text,
    "Objective"  text,
    "Comments"   text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_supports_and_constaints
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Stakeholder"     text,
    "Influence"       numeric,
    "Weight"          numeric,
    "ConstraintLevel" numeric,
    "Comments"        text,
    group_key         character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_objectives_supports_and_contraints
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Element"    text,
    "Status"     text,
    "Objective"  text,
    "Comments"   text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_threats
(
    id              serial PRIMARY KEY,
    "FormID"        integer,
    "UpdateBy"      integer,
    "UpdateDate"    character varying(30),
    "Value"         text,
    "Impact"        numeric,
    "Extension"     numeric,
    "Duration"      numeric,
    "Trend"         numeric,
    "Probability"   numeric,
    group_key       character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_objectives_threats
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Element"    text,
    "Status"     text,
    "Objective"  text,
    "Comments"   text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE imet_oecm.eval_regulations_adequacy
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Regulation"      text,
    "EvaluationScore" numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_design_adequacy
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Values"          text,
    "EvaluationScore" numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_boundary_level
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Boundaries" numeric,
    "Adequacy"   numeric,
    "Comments"   text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_management_plan
(
    id                  serial PRIMARY KEY,
    "FormID"            integer,
    "UpdateBy"          integer,
    "UpdateDate"        character varying(30),
    "PlanExistence"     boolean,
    "PlanUptoDate"      boolean,
    "PlanApproved"      boolean,
    "PlanImplemented"   boolean,
    "PlanAdequacyScore" numeric,
    "Comments"          text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_work_plan
(
    id                  serial PRIMARY KEY,
    "FormID"            integer,
    "UpdateBy"          integer,
    "UpdateDate"        character varying(30),
    "PlanExistence"     boolean,
    "PlanUptoDate"      boolean,
    "PlanApproved"      boolean,
    "PlanImplemented"   boolean,
    "PlanAdequacyScore" numeric,
    "Comments"          text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_objectives
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Objective"       text,
    "Existence"       boolean,
    "EvaluationScore" numeric,
    "Comments"        text,
    "group_key"      character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_objectives_planification
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

CREATE TABLE imet_oecm.eval_information_availability
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Element"         text,
    "EvaluationScore" numeric,
    "Comments"        text,
    group_key         character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_capacity_adequacy
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Member"     text,
    "Weight"     numeric,
    "Adequacy"   numeric,
    "Comments"   text,
    group_key    character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_budget_adequacy
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "EvaluationScore" numeric,
    "Percentage"      numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_budget_securization
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "EvaluationScore" numeric,
    "Percentage"      numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_management_equipment_adequacy
(
    id             serial PRIMARY KEY,
    "FormID"       integer,
    "UpdateBy"     integer,
    "UpdateDate"   character varying(30),
    "Equipment"    text,
    "Adequacy"     numeric,
    "PresentNeeds" numeric,
    "Comments"     text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_objectives_intrants
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

CREATE TABLE imet_oecm.eval_objectives_processus
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

CREATE TABLE imet_oecm.eval_staff_competence
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Member"           text,
    "Weight"            numeric,
    "Adequacy"          numeric,
    "Comments"        text,
    group_key          character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_hr_management_politics
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Conditions"      text,
    "EvaluationScore" numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_administrative_management
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Aspect"          text,
    "EvaluationScore" numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_equipment_maintenance
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Equipment"       text,
    "AdequacyLevel"   numeric,
    "EvaluationScore" numeric,
    "Percentage"      numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_management_activities
(
    id                 serial PRIMARY KEY,
    "FormID"           integer,
    "UpdateBy"         integer,
    "UpdateDate"       character varying(30),
    "Activity"         text,
    "EvaluationScore"  numeric,
    "InManagementPlan" numeric,
    "Comments"         text,
    group_key          character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_assistance_activities
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Activity"        text,
    "EvaluationScore" numeric,
    "Comments"        text,
    group_key         character varying(25),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_actors_relations
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Activity"        text,
    "EvaluationScore" numeric,
    "Percentage"      numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_visitors_management
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Aspect"          text,
    "EvaluationScore" numeric,
    "Comments"        text,
    group_key         character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_natural_resources_monitoring
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Aspect"          text,
    "EvaluationScore" numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_work_program_implementation
(
    id                 serial PRIMARY KEY,
    "FormID"           integer,
    "UpdateBy"         integer,
    "UpdateDate"       character varying(30),
    "Activity"         text,
    "EvaluationScore"  numeric,
    "Percentage"       numeric,
    "Comments"         text,
    "Action"           text,
    "Category"         text,
    "TargetedActivity" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_management_governance
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Patrol"     numeric,
    "Comments"   text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_achived_objectives
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Objective"       text,
    "EvaluationScore" numeric,
    "Percentage"      numeric,
    "Comments"        text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_life_quality_impact
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Element"         text,
    "EvaluationScore" numeric,
    "Comments"        text,
    group_key         character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_empowerment_governance
(
    id                serial PRIMARY KEY,
    "FormID"          integer,
    "UpdateBy"        integer,
    "UpdateDate"      character varying(30),
    "Conditions"      text,
    "EvaluationScore" numeric,
    "Comments"        text,
    group_key         character varying(25),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_law_enforcement_implementation
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Element"    text,
    "Adequacy"   numeric,
    "Comments"   text,
    group_key    character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_stakeholder_cooperation
(
    id            serial PRIMARY KEY,
    "FormID"      integer,
    "UpdateBy"    integer,
    "UpdateDate"  character varying(30),
    "Element"     text,
    "Cooperation" numeric,
    "Weight"      numeric,
    "Comments"    text,
    group_key     character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.imet_report
(
    id                            serial PRIMARY KEY,
    "FormID"                      integer,
    analysis                      text,
    key_elements_comment          text,
    strengths_swot                text,
    weaknesses_swot               text,
    opportunities_swot            text,
    threats_swot                  text,
    priorities                    text,
    minimum_budget                text,
    additional_funding            text,
    previous_state                text,
    impacts                       text,
    current_state                 text,
    responses                     text,
    expected_conditions           text,
    long_term                     text,
    long_term_year1               boolean default false,
    long_term_year2               boolean default false,
    long_term_year3               boolean default false,
    long_term_year4               boolean default false,
    long_term_year5               boolean default false,
    outcome                       text,
    outcome_year1                 boolean default false,
    outcome_year2                 boolean default false,
    outcome_year3                 boolean default false,
    outcome_year4                 boolean default false,
    outcome_year5                 boolean default false,
    annual_targets                text,
    annual_targets_year1          boolean default false,
    annual_targets_year2          boolean default false,
    annual_targets_year3          boolean default false,
    annual_targets_year4          boolean default false,
    annual_targets_year5          boolean default false,
    intervention1                 text,
    intervention1_year1           boolean default false,
    intervention1_year2           boolean default false,
    intervention1_year3           boolean default false,
    intervention1_year4           boolean default false,
    intervention1_year5           boolean default false,
    intervention1_activity1       text,
    intervention1_activity1_year1 boolean default false,
    intervention1_activity1_year2 boolean default false,
    intervention1_activity1_year3 boolean default false,
    intervention1_activity1_year4 boolean default false,
    intervention1_activity1_year5 boolean default false,
    intervention1_activity2       text,
    intervention1_activity2_year1 boolean default false,
    intervention1_activity2_year2 boolean default false,
    intervention1_activity2_year3 boolean default false,
    intervention1_activity2_year4 boolean default false,
    intervention1_activity2_year5 boolean default false,
    intervention1_other           text,
    intervention1_other_year1     boolean default false,
    intervention1_other_year2     boolean default false,
    intervention1_other_year3     boolean default false,
    intervention1_other_year4     boolean default false,
    intervention1_other_year5     boolean default false,
    intervention2                 text,
    intervention2_year1           boolean default false,
    intervention2_year2           boolean default false,
    intervention2_year3           boolean default false,
    intervention2_year4           boolean default false,
    intervention2_year5           boolean default false,
    intervention2_activity1       text,
    intervention2_activity1_year1 boolean default false,
    intervention2_activity1_year2 boolean default false,
    intervention2_activity1_year3 boolean default false,
    intervention2_activity1_year4 boolean default false,
    intervention2_activity1_year5 boolean default false,
    intervention2_activity2       text,
    intervention2_activity2_year1 boolean default false,
    intervention2_activity2_year2 boolean default false,
    intervention2_activity2_year3 boolean default false,
    intervention2_activity2_year4 boolean default false,
    intervention2_activity2_year5 boolean default false,
    intervention2_other           text,
    intervention2_other_year1     boolean default false,
    intervention2_other_year2     boolean default false,
    intervention2_other_year3     boolean default false,
    intervention2_other_year4     boolean default false,
    intervention2_other_year5     boolean default false,
    "UpdateDate"                  character varying(30),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

COMMIT;
