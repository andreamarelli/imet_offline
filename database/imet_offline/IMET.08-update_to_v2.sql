BEGIN;

ALTER TABLE imet.context_objectives1 ADD COLUMN "Element" text;
ALTER TABLE imet.context_objectives2 ADD COLUMN "Element" text;
ALTER TABLE imet.context_objectives3 ADD COLUMN "Element" text;
ALTER TABLE imet.context_objectives4 ADD COLUMN "Element" text;
ALTER TABLE imet.context_objectives5 ADD COLUMN "Element" text;
ALTER TABLE imet.context_objectives6 ADD COLUMN "Element" text;
ALTER TABLE imet.context_objectives7 ADD COLUMN "Element" text;

ALTER TABLE imet.eval_supports_and_constaints ADD COLUMN group_key character varying(25);

ALTER TABLE imet.eval_objectives_c12 ADD COLUMN comments text;
ALTER TABLE imet.eval_objectives_c13 ADD COLUMN comments text;
ALTER TABLE imet.eval_objectives_c14 ADD COLUMN comments text;
ALTER TABLE imet.eval_objectives_c15 ADD COLUMN comments text;
ALTER TABLE imet.eval_objectives_c16 ADD COLUMN comments text;
ALTER TABLE imet.eval_objectives_c2 ADD COLUMN comments text;
ALTER TABLE imet.eval_objectives_c3 ADD COLUMN comments text;
ALTER TABLE imet.eval_objectives_intrants ADD COLUMN "comments" text;
ALTER TABLE imet.eval_objectives_planification ADD COLUMN "comments" text;
ALTER TABLE imet.eval_objectives_processus ADD COLUMN "comments" text;

ALTER TABLE imet.eval_objectives_c12 ADD COLUMN "Element" text;
ALTER TABLE imet.eval_objectives_c13 ADD COLUMN "Element" text;
ALTER TABLE imet.eval_objectives_c14 ADD COLUMN "Element" text;
ALTER TABLE imet.eval_objectives_c15 ADD COLUMN "Element" text;
ALTER TABLE imet.eval_objectives_c16 ADD COLUMN "Element" text;
ALTER TABLE imet.eval_objectives_c2 ADD COLUMN "Element" text;
ALTER TABLE imet.eval_objectives_c3 ADD COLUMN "Element" text;
ALTER TABLE imet.eval_objectives_intrants ADD COLUMN "Element" text;
ALTER TABLE imet.eval_objectives_planification ADD COLUMN "Element" text;
ALTER TABLE imet.eval_objectives_processus ADD COLUMN "Element" text;

CREATE TABLE imet.eval_boundary_level_v2
(
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Boundaries" numeric,
  "BoundariesComments" text,
  "Adequacy" character varying(350),
  "EvaluationScore" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE imet.eval_management_plan ADD COLUMN "PlanExistence" BOOLEAN;
ALTER TABLE imet.eval_management_plan ADD COLUMN "PlanUptoDate" BOOLEAN;
ALTER TABLE imet.eval_management_plan ADD COLUMN "PlanApproved" BOOLEAN;
ALTER TABLE imet.eval_management_plan ADD COLUMN "PlanImplemented" BOOLEAN;
ALTER TABLE imet.eval_management_plan ADD COLUMN "VisionAdequacy" numeric;
ALTER TABLE imet.eval_management_plan ADD COLUMN "PlanAdequacyScore" numeric;

ALTER TABLE imet.eval_work_plan ADD COLUMN "PlanExistence" BOOLEAN;
ALTER TABLE imet.eval_work_plan ADD COLUMN "PlanUptoDate" BOOLEAN;
ALTER TABLE imet.eval_work_plan ADD COLUMN "PlanApproved" BOOLEAN;
ALTER TABLE imet.eval_work_plan ADD COLUMN "PlanImplemented" BOOLEAN;
ALTER TABLE imet.eval_work_plan ADD COLUMN "VisionAdequacy" numeric;
ALTER TABLE imet.eval_work_plan ADD COLUMN "PlanAdequacyScore" numeric;

ALTER TABLE imet.eval_staff ADD COLUMN "StaffNumberAdequacy" numeric;
ALTER TABLE imet.eval_staff ADD COLUMN "StaffCapacityAdequacy" numeric;

ALTER TABLE imet.eval_administrative_management ADD COLUMN "Aspect" text;

ALTER TABLE imet.eval_equipment_maintenance ADD COLUMN "AdequacyLevel" numeric;

ALTER TABLE imet.eval_management_activities ADD COLUMN "InManagementPlan" numeric;

CREATE TABLE imet.eval_law_enforcement_implementation (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Element" text,
  "Adequacy" numeric,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_intelligence_implementation (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Element" text,
  "Adequacy" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_stakeholder_cooperation (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Element" text,
  "Cooperation" numeric,
  "MPInvolvement" numeric,
  "MPIImplementation" numeric,
  "BAInvolvement" numeric,
  "EEInvolvement" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE imet.eval_assistance_activities ADD COLUMN group_key character varying(25);

ALTER TABLE imet.eval_work_program_implementation ADD COLUMN "Category" text;
ALTER TABLE imet.eval_work_program_implementation ADD COLUMN "TargetedActivity" text;
ALTER TABLE imet.eval_achieved_results ADD COLUMN "Category" text;
ALTER TABLE imet.eval_achieved_results ADD COLUMN "TargetedOutput" text;

CREATE TABLE imet.eval_area_domination (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Patrol" numeric,
  "RapidIntervention" numeric,
  "AirVehicles" boolean,
  "Planes" boolean,
  "Comments" text,
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_key_conservation_trends (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Element" text,
  "Condition" numeric,
  "Trend" numeric,
  "Reliability" character varying(30),
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet.eval_life_quality_impact (
  id serial PRIMARY KEY,
  "FormID" integer,
  "UpdateBy" integer,
  "UpdateDate" character varying(30),
  "Element" text,
  "EvaluationScore" numeric,
  "Comments" text,
  group_key character varying(50),
  CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

COMMIT;