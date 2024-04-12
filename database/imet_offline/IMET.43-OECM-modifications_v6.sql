BEGIN;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS objectives json DEFAULT '{}';

COMMIT;
