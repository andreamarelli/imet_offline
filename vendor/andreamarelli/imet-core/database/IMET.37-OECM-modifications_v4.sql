BEGIN;

ALTER TABLE imet_oecm.context_governance DROP COLUMN IF EXISTS "ManagementList";

DELETE FROM imet_oecm.context_analysis_stakeholders_direct_users WHERE group_key IN ('group11', 'group12', 'group13');
ALTER TABLE imet_oecm.context_analysis_stakeholders_direct_users DROP COLUMN IF EXISTS "Description";

DELETE FROM imet_oecm.context_analysis_stakeholders_indirect_users WHERE group_key IN ('group11', 'group12', 'group13');
ALTER TABLE imet_oecm.context_analysis_stakeholders_indirect_users DROP COLUMN IF EXISTS "Description";

DELETE FROM imet_oecm.eval_supports_constraints WHERE group_key IS null;
DELETE FROM imet_oecm.eval_supports_constraints_integration WHERE group_key IS null;

DELETE FROM imet_oecm.eval_key_elements;
DELETE FROM imet_oecm.eval_objectives;
DELETE FROM imet_oecm.eval_information_availability;
DELETE FROM imet_oecm.eval_management_activities;
DELETE FROM imet_oecm.eval_stakeholder_cooperation;

CREATE TABLE IF NOT EXISTS imet_oecm.eval_threats_biodiversity
(
    id              serial PRIMARY KEY,
    "FormID"        integer,
    "UpdateBy"      integer,
    "UpdateDate"    character varying(30),
    "Criteria"      text,
    "Threats"       text,
    "Note"      text,
    group_key       character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year5";

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity1 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity1_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity1_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity1_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity1_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity1_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity2 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity2_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity2_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity2_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity2_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity2_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS outcome2 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS outcome2_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS outcome2_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS outcome2_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS outcome2_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS outcome2_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity1 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity1_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity1_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity1_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity1_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity1_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity2 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity2_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity2_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity2_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity2_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity2_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity3 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity3_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity3_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity3_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity3_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity3_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity4 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity4_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity4_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity4_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity4_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity4_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity5 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity5_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity5_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity5_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity5_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets2_activity5_year5 boolean default false;

COMMIT;
