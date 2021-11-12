BEGIN;

CREATE TABLE imet.imet_pas_non_wdpa(
    id                  integer primary key,
    name                text,
    designation         text,
    designation_type    text,
    status              text,
    country             text,
    last_update_by integer,
    last_update_date character varying
);

COMMIT;
