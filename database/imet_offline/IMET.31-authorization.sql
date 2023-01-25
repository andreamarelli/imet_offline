BEGIN;

-- Remove unnecessary tables and columns
DROP TABLE IF EXISTS user_roles_imet;
DROP TABLE IF EXISTS user_rights;
DROP TABLE IF EXISTS persons;
ALTER TABLE users DROP COLUMN IF EXISTS person_id;
ALTER TABLE users DROP COLUMN IF EXISTS profile_type;

-- ADD role type column to users TABLE
ALTER TABLE users ADD COLUMN IF NOT EXISTS imet_role VARCHAR(25);

-- CREATE role's TABLE
CREATE TABLE IF NOT EXISTS user_roles(
    id serial PRIMARY KEY,
    user_id integer,
    country character varying(3),
    wdpa character varying(25),
    last_update_by integer,
    last_update_date character varying(30),
    CONSTRAINT "user_fk" FOREIGN KEY (user_id) REFERENCES users (id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT "last_update_fk" FOREIGN KEY (user_id) REFERENCES users (id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

COMMIT;