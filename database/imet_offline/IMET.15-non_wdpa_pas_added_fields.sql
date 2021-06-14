BEGIN;

ALTER TABLE imet.imet_pas_non_wdpa ADD COLUMN pa_def integer;
ALTER TABLE imet.imet_pas_non_wdpa ADD COLUMN origin_name text;
ALTER TABLE imet.imet_pas_non_wdpa ADD COLUMN designation_eng text;
ALTER TABLE imet.imet_pas_non_wdpa ADD COLUMN marine integer;
ALTER TABLE imet.imet_pas_non_wdpa ADD COLUMN rep_m_area numeric;
ALTER TABLE imet.imet_pas_non_wdpa ADD COLUMN rep_area numeric;
ALTER TABLE imet.imet_pas_non_wdpa ADD COLUMN status_year integer;

COMMIT;
