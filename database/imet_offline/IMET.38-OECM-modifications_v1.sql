BEGIN;

CREATE TABLE IF NOT EXISTS imet_oecm.context_objectives4 (
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

ALTER TABLE imet_oecm.context_analysis_stakeholders_direct_users ADD COLUMN IF NOT EXISTS "Description" text;
ALTER TABLE imet_oecm.context_analysis_stakeholders_indirect_users ADD COLUMN IF NOT EXISTS "Description" text;

ALTER TABLE imet_oecm.eval_threats_biodiversity DROP COLUMN IF EXISTS "Threats";
ALTER TABLE imet_oecm.eval_threats_biodiversity ADD COLUMN IF NOT EXISTS "Impact" numeric;
ALTER TABLE imet_oecm.eval_threats_biodiversity ADD COLUMN IF NOT EXISTS "Extension" numeric;
ALTER TABLE imet_oecm.eval_threats_biodiversity ADD COLUMN IF NOT EXISTS "Duration" numeric;
ALTER TABLE imet_oecm.eval_threats_biodiversity ADD COLUMN IF NOT EXISTS "Trend" numeric;
ALTER TABLE imet_oecm.eval_threats_biodiversity ADD COLUMN IF NOT EXISTS "Probability" numeric;

COMMIT;