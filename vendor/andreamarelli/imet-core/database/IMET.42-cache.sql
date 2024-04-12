BEGIN;

DROP TABLE IF EXISTS imet.imet_scores;

CREATE TABLE IF NOT EXISTS cache(
    key character varying UNIQUE,
    value text,
    expiration integer
);

COMMIT;