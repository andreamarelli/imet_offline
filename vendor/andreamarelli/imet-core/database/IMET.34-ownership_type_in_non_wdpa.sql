BEGIN;

ALTER TABLE imet.imet_pas_non_wdpa ADD COLUMN ownership_type text;

COMMIT;