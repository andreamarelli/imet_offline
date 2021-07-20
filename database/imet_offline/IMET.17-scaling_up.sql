
BEGIN;

CREATE TABLE imet.scaling_up
(
    id serial PRIMARY KEY,
    wdpas character varying(500) NOT NULL
);

CREATE TABLE imet.scaling_up_basket
(
    id serial PRIMARY KEY,
    "order" integer NOT NULL,
    item character varying(500),
    comment text,
    scaling_up_id integer NOT NULL
);

COMMIT;
