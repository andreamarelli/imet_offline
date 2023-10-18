BEGIN;
ALTER TABLE imet_oecm.eval_objectives DROP COLUMN IF EXISTS "IncludeInPlanning";
COMMIT;
