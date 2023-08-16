BEGIN;

ALTER TABLE imet_oecm.context_governance DROP COLUMN IF EXISTS "ManagementList";

DELETE FROM imet_oecm.context_analysis_stakeholders_direct_users WHERE group_key IN ('group11', 'group12', 'group13');
ALTER TABLE imet_oecm.context_analysis_stakeholders_direct_users DROP COLUMN IF EXISTS "Description";

DELETE FROM imet_oecm.context_analysis_stakeholders_indirect_users WHERE group_key IN ('group11', 'group12', 'group13');
ALTER TABLE imet_oecm.context_analysis_stakeholders_indirect_users DROP COLUMN IF EXISTS "Description";

DELETE FROM imet_oecm.eval_supports_constraints WHERE group_key IS null;
DELETE FROM imet_oecm.eval_supports_constraints_integration WHERE group_key IS null;

CREATE TABLE imet_oecm.eval_threats_biodiversity
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

COMMIT;