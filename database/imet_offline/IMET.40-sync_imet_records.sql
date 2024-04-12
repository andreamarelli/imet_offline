BEGIN;

CREATE TABLE imet.imet_scores
(
    id       serial PRIMARY KEY,
    "UpdateBy" integer,
    "UpdateDate" character varying(30),
    "FormID" integer,
    scores   json,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE imet.imet_form
    ADD COLUMN IF NOT EXISTS sync_unique_id varchar(40) default null;
ALTER TABLE imet.imet_form
    ADD COLUMN IF NOT EXISTS synced boolean default false;

COMMIT;
