BEGIN;


CREATE TABLE persons
(
  id serial PRIMARY KEY,
  email character varying,
  first_name character varying,
  last_name character varying,
  organisation character varying,
  function character varying,
  category_filter character varying,
  country character varying,
  address character varying,
  city character varying,
  telephone character varying,
  reference character varying,
  document character varying,
  role_ofac character varying,
  role_redd character varying,
  last_update_by integer,
  last_update_date character varying
);

CREATE TABLE users
(
  id serial NOT NULL,
  person_id integer,
  profile_type character varying,
  password character varying(60),
  remember_token text,
  last_update_by integer,
  last_update_date character varying,
  email character varying(100),
  CONSTRAINT user_pkey PRIMARY KEY (id),
  CONSTRAINT person_fkey FOREIGN KEY (person_id)
  REFERENCES persons (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE OR REPLACE FUNCTION copy_email()
  RETURNS trigger AS
$BODY$
BEGIN
  UPDATE users
  SET email = new.email
  WHERE users.person_id = new.id;
  RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql VOLATILE
COST 100;

CREATE TABLE user_rights
(
  id serial NOT NULL,
  user_id integer,
  scope character varying,
  country character(3),
  site character varying,
  role character varying,
  access boolean,
  encode boolean,
  modify boolean,
  validate boolean,
  delete boolean,
  last_update_date character varying,
  last_update_by integer,
  CONSTRAINT user_rights_pkey PRIMARY KEY (id),
  CONSTRAINT user_fkey FOREIGN KEY (user_id)
  REFERENCES users (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE user_roles_imet(
    id               SERIAL PRIMARY KEY,
    user_id          integer,
    wdpa             integer,
    role             varchar(35),
    last_update_date varchar(30),
    last_update_by   integer
);

CREATE TABLE species
(
  id serial PRIMARY KEY,
  kingdom  character varying(100),
  phylum character varying(100),
  class character varying(100),
  "order" character varying(100),
  family character varying(100),
  genus character varying(250),
  species character varying(250),
  common_name_fr character varying(500),
  common_name_en character varying(500),
  common_name_sp character varying(500),
  iucn_redlist_id integer,
  iucn_redlist_category character varying(5),
  country_distribution json,
  last_update_by integer,
  last_update_date character varying(30)
);

CREATE SCHEMA imet;

-- ### Utility tables ##

CREATE TABLE imet.imet_pas (
  global_id     text PRIMARY KEY,   -- region + '_' + local_id
  country       text,
  wdpa_id       integer,
  name          text,
  iucn_category text,
  creation_date text,
  perimeter     numeric,
  area          numeric,
  shape_index   numeric
);

CREATE TABLE imet.imet_countries (
  iso2      text,
  iso3      text PRIMARY KEY,
  iso       integer,
  name_fr   text,
  name_en   text,
  name_sp   text
);

CREATE TABLE imet.imet_currencies (
  iso       text PRIMARY KEY,
  name_fr   text,
  name_en   text,
  name_sp   text
);

-- ### Form tables ##

CREATE TABLE imet.imet_form (
  "FormID" serial PRIMARY KEY,
  "Year" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "language" character(2),
  version character(2),
  "Country" character(3),
  validation character varying(25),
  wdpa_id integer,
  name text
);

CREATE TABLE imet.imet_metadata (
  id serial PRIMARY KEY,
  version character(2),
  phase character varying(25),
  code character varying(10),
  db_table character varying(60),
  title_fr text,
  title_en text,
  title_sp text
);

CREATE TABLE imet.imet_metadata_statistics (
  id serial PRIMARY KEY,
  version character(2),
  code character varying(10),
  code_label character varying(15),
  title_fr text,
  title_en text,
  title_sp text
);

CREATE TABLE imet.imet_encoders (
  id serial PRIMARY KEY,
  "FormID" integer,
  first_name character varying,
  last_name character varying,
  organisation character varying,
  function character varying,
  "UpdateDate" character varying(30),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.imet_report (
    id serial PRIMARY KEY,
    "FormID" integer,
    key_species_comment text,
    habitats_comment text,
    climate_change_comment text,
    ecosystem_services_comment text,
    threats_comment text,
    analysis text,
    strengths_swot text,
    weaknesses_swot text,
    opportunities_swot text,
    threats_swot text,
    recommendations text,
    priorities text,
    minimum_budget text,
    additional_funding text,
    "UpdateDate" character varying(30),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

-- ### Modules' tables ##

CREATE TABLE imet.context_areas (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "AdministrativeArea" numeric,
  "GISArea" numeric,
  "BoundaryLength" numeric,
  "TerrestrialArea" numeric,
  "MarineArea" numeric,
  "PercentageNationalNetwork" numeric,
  "PercentageEcoregion" numeric,
  "PercentageTransnationalNetwork" numeric,
  "PercentageLandscapeNetwork" numeric,
  "Index" character varying(25),
  "Observations" text,
  "WDPAArea" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_climate_change_changements (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Value" text,
  "Description" text,
  "DesiredStatus" text,
  "Trend" numeric,
  "Notes" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_climate_change_importance_elements (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Element" text,
  "Application" numeric,
  "Observations" text,
  "GroupElement" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_contexts (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Context" text,
  file text,
  "file_BYTEA" bytea,
  "Summary" text,
  "Observations" text,
  "Source" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_control_level (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "UnderControlArea" numeric,
  "UnderControlPatrolKm" numeric,
  "UnderControlPatrolManDay" numeric,
  "EcologicalMonitoringPatrolKm" numeric,
  "Observations" text,
  "Source" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_ecosystem_services_tendance (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Value" text,
  "Description" text,
  "DesiredStatus" text,
  "Trend" numeric,
  "Notes" text,
  "Reliability" character varying(25),
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_ecosystem_services (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Element" text,
  "Importance" numeric,
  "Observations" text,
  "ImportanceRegional" numeric,
  "ImportanceGlobal" numeric,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_encoding_responsables_interviewees (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Name" text,
  "Institution" text,
  "Function" text,
  "Contacts" text,
  "EncodingDate" character varying(30),
  "EncodingDuration" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_encoding_responsables_interviewers (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Name" text,
  "Institution" text,
  "Function" text,
  "Contacts" text,
  "EncodingDate" character varying(30),
  "EncodingDuration" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_equipments (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Resource" character varying(250),
  "AdequacyLevel" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_achieved_results (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Activity" text,
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_achived_objectives (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Objective" text,
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_actors_relations (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Activity" text,
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_administrative_management (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_assistance_activities (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Activity" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_boundary_level (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "EvaluationScore" numeric,
  "PercentageLevel" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_budget_adequacy (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_budget_securization (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_climate_change_impact (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Impact" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_climate_change_monitoring (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Program" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_control (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_design_adequacy (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Values" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_designated_values_conservation_tendency (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Value" text,
  "EvaluationScore" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_designated_values_conservation (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Value" text,
  "EvaluationScore" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_ecosystem_services_impact (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Impact" text,
  "EvaluationScore" numeric,
  "Type" character varying(5),
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_ecosystem_services (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Intervention" text,
  "EvaluationScore" numeric,
  "Type" character varying(30),
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_equipment_maintenance (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Equipment" text,
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_governance_leadership (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "EvaluationScoreGovernace" numeric,
  "EvaluationScoreLeadership" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_hr_management_politics (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Conditions" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_hr_management_systems (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Conditions" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_implications (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Actor" text,
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_importance_c11 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_importance_c12 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "Comments" text,
  "SignificativeClassification" boolean,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_importance_c13 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "Comments" text,
  "SignificativeSpecies" boolean,
  "IncludeInStatistics" boolean,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_importance_c15 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "IncludeInStatistics" boolean,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_importance_c14 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "EvaluationScore2" numeric,
  "IncludeInStatistics" boolean,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_importance_c16 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "IncludeInStatistics" boolean,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_information_availability (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Element" text,
  "EvaluationScore" numeric,
  "PercentageLevel" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_law_enforcement (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Element" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_local_communities_impact (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Impact" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_management_activities (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Activity" text,
  "EvaluationScore" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_management_equipment_adequacy (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Equipment" text,
  "EvaluationScore" numeric,
  "Importance" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_management_plan (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "PercentageLevel" numeric,
  "Comments" text,
  "PlanExistenceScore" numeric,
  "PlanApplicationScore" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_menaces (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "IncludeInStatistics" boolean,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_natural_resources_monitoring (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_c11 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_c12 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_c13 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_c14 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_c15 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_c16 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_c2 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_c3 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_intrants (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_planification (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives_processus (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_objectives (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "EvaluationScore" numeric,
  "Comments" text,
  "Objective" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_protection_activities (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Activity" text,
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_regulations_adequacy (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Regulation" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_research_and_monitoring (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Program" text,
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_staff_competence (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Theme" text,
  "EvaluationScore" numeric,
  "PercentageLevel" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_staff (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Theme" text,
  "EvaluationScore" numeric,
  "PercentageLevel" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_supports_and_constaints (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "Comments" text,
  "EvaluationScore2" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_visitors_impact (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Impact" text,
  "EvaluationScore" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_visitors_management (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Aspect" text,
  "EvaluationScore" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_work_plan (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "PercentageLevel" numeric,
  "Comments" text,
  "PlanExistenceScore" numeric,
  "PlanApplicationScore" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_work_program_implementation (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Activity" text,
  "EvaluationScore" numeric,
  "Percentage" numeric,
  "Comments" text,
  "Action" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_financial_available_resources (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Currency" character(3),
  "BudgetType" text,
  "NationalBudget" numeric,
  "OwnRevenues" numeric,
  "Partners" numeric,
  "Disputes" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_financial_resources_budget_lines (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Currency" character(3),
  "Line" character(500),
  "Amount" numeric,
  "BudgetSource" character(500),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_financial_resources_partners (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Partner" text,
  "Funding" text,
  "Contribution" numeric,
  "StartDate" date,
  "EndDate" date,
  "Observations" text,
  "Currency" character(3),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_financial_resources (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Currency" character(3),
  "ReferenceYear" numeric,
  "ManagementFinancialPlanCosts" numeric,
  "OperationalWorkPlanCosts" numeric,
  "TotalBudget" numeric,
  "AvailableTotalBudget" numeric,
  "AvailableOperatingTotalBudget" numeric,
  "AvailableInvestmentTotalBudget" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_general_info (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "NationalCategory" text,
  "Institution" text,
  "Ecotype" text,
  "ReferenceText" text,
  "ReferenceTextDocument" text,
  "ReferenceTextDocument_BYTEA" bytea,
  "CompleteName" text,
  "CompleteNameWDPA" text,
  "UsedName" text,
  "WDPA" integer,
  "Type" character varying(35),
  "IUCNCategory1" text,
  "IUCNCategory2" text,
  "IUCNCategory3" text,
  "Country" character(3),
  "CreationYear" integer,
  "Biome" text,
  "Ecoregions" text,
  "ReferenceTextValues" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_governance (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Type" text,
  "Comments" text,
  "Partner" text,
  "InstitutionType" text,
  "PartnershipsType1" text,
  "PartnershipsType2" text,
  "PartnershipsType3" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_habitats_marine (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "HabitatType" character varying(150),
  "Presence" character varying(150),
  "Area" numeric,
  "Fragmentation" text,
  "Source" text,
  "Description" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_habitats (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "EcosystemType" text,
  "Value" text,
  "Area" numeric,
  "Trend" character varying(30),
  "Reliability" character varying(30),
  "Sectors" text,
  "Comments" text,
  "DesiredConservationStatus" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_land_cover (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "CoverType" text,
  "HistoricalArea" numeric,
  "ConservationStatusArea" numeric,
  "Trend" character varying(30),
  "Reliability" character varying(30),
  "Notes" text,
  "PreviousEstimationArea" numeric,
  "CurrentEstimationArea" numeric,
  "HistoricalAreaData" character varying(50),
  "PreviousEstimationAreaData" character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_localization (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "LimitsExist" boolean,
  "Shapefile" character varying(255),
  "Shapefile_BYTEA" bytea,
  "SourceSHP" text,
  "Coordinates" text,
  "SourceCoords" text,
  "AdministrativeLocation" text,
  "Observations" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_management_staff_communities (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Community" text,
  "Role1" text,
  "StaffNUmberRole1" numeric,
  "Role2" text,
  "StaffNUmberRole2" numeric,
  "Role3" text,
  "StaffNUmberRole3" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_management_staff_partners (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Partner" text,
  "Coordinators" numeric,
  "Technicians" numeric,
  "Auxiliaries" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_management_staff (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Function" text,
  "ExpectedPermanent" numeric,
  "ActualPermanent" numeric,
  "Temporary" numeric,
  "Observations" text,
  "Source" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_menaces_pressions (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Value" character varying(250),
  "Impact" numeric,
  "Extension" numeric,
  "Duration" numeric,
  "Trend" numeric,
  "Probability" numeric,
  "Code" character varying(10),
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_missions (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "LocalVision" text,
  "LocalMission" text,
  "LocalObjective" text,
  "LocalSource" text,
  "LocalManagementPlan" character varying(256),
  "LocalManagementPlan_BYTEA" bytea,
  "InternationalVision" text,
  "InternationalMission" text,
  "InternationalObjective" text,
  "InternationalSource" text,
  "InternationalManagementPlan" character varying(256),
  "InternationalManagementPlan_BYTEA" bytea,
  "Observation" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_networks (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "NetworkName" text,
  "ProtectedAreas" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_non_sustainable_usage (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "HabitatParameter" text,
  "HistoricalArea" numeric,
  "Trend" character varying(30),
  "Reliability" character varying(30),
  "Sectors" text,
  "PreviousEstimationArea" numeric,
  "CurrentEstimationArea" numeric,
  "HistoricalAreaData" character varying(50),
  "PreviousEstimationAreaData" character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_objectives1 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_objectives2 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_objectives3 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_objectives4 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_objectives5 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_objectives6 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_objectives7 (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Status" text,
  "Benchmark1" text,
  "Benchmark2" text,
  "Objective" text,
  "Benchmark3" text,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_sectors (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Name" character varying(250),
  "Objectives" text,
  "Restrictions" text,
  "Source" text,
  "Observations" text,
  "SectorMap" text,
  "SectorMap_BYTEA" bytea,
  "UnderControlArea" numeric,
  "UnderControlPatrolKm" numeric,
  "UnderControlPatrolManDay" numeric,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_special_status (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Designation" character varying(250),
  "RegistrationDate" character varying(30),
  "DesignationCriteria" text,
  "Code" character varying(250),
  "Area" numeric,
  upload character varying(256),
  "upload_BYTEA" bytea,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_species_animal_presence (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "SpeciesID" integer,
  "FlagshipSpecies" boolean,
  "EndangeredSpecies" boolean,
  "EndemicSpecies" boolean,
  "ExploitedSpecies" boolean,
  "InvasiveSpecies" boolean,
  "InsufficientDataSpecies" boolean,
  "PopulationEstimation" numeric,
  "DesiredPopulation" numeric,
  "TrendRating" numeric,
  "Reliability" character varying(25),
  "Comments" text,
  species character varying(250),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_species_vegetal_presence (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "FlagshipSpecies" boolean,
  "EndangeredSpecies" boolean,
  "EndemicSpecies" boolean,
  "ExploitedSpecies" boolean,
  "InvasiveSpecies" boolean,
  "InsufficientDataSpecies" boolean,
  "PopulationEstimation" numeric,
  "DesiredPopulation" numeric,
  "TrendRating" numeric,
  "Reliability" character varying(25),
  "Comments" text,
  "Species" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.context_territorial_reference_context (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "ReferenceEcosystemAreaEstimation" numeric,
  "ReferenceEcosystemAreaPopulation" numeric,
  "EcologicalAspects" text,
  "FunctionalArea" numeric,
  "FunctionalAreaPopulation" numeric,
  "SocioEconomicAspects" text,
  "SpillOverEffect" text,
  "NoTakeArea" boolean,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


COMMIT;