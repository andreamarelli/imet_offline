BEGIN;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity3 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity3_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity3_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity3_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity3_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity3_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity4 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity4_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity4_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity4_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity4_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity4_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity5 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity5_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity5_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity5_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity5_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN IF NOT EXISTS annual_targets1_activity5_year5 boolean default false;

COMMIT;
