BEGIN;

DROP TABLE IF EXISTS cache;
CREATE TABLE IF NOT EXISTS cache(
    key character varying UNIQUE,
    value text,
    expiration integer
);

COMMIT;