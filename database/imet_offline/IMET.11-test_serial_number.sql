BEGIN;

DROP TABLE IF EXISTS imet.offline_hash;
CREATE TABLE IF NOT EXISTS imet.offline_serial_number
(
    serial_number varchar(250) PRIMARY KEY
);

COMMIT;
