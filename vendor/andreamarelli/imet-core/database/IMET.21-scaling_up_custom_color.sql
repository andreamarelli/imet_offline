BEGIN;

ALTER TABLE imet.scaling_up_wdpas ADD COLUMN color character varying(20);

COMMIT;
