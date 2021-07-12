
BEGIN;

CREATE TABLE imet.scaling_up
(
    id serial PRIMARY KEY,
    wdpas character varying(500) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT scaling_up_pkey PRIMARY KEY (id)
);

CREATE TABLE imet.scaling_up_basket
(
    id serial PRIMARY KEY,
    "order" integer NOT NULL,
    item character varying COLLATE pg_catalog."default",
    comment character varying COLLATE pg_catalog."default",
    scaling_up_id integer NOT NULL,
    CONSTRAINT scaling_up_basket_pkey PRIMARY KEY (id)
);

COMMIT;
