
BEGIN;

CREATE TABLE imet.scaling_up_wdpas
(
    id serial NOT NULL,
    "FormID" integer,
    scaling_id integer,
    name character varying(100),
    "Country" character(3),
    wdpa_id integer,
    CONSTRAINT sclaing_up_wdpas_pkey PRIMARY KEY (id),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT scaling_id_fkey FOREIGN KEY (scaling_id) REFERENCES imet.scaling_up (id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE CASCADE
);

COMMIT;
