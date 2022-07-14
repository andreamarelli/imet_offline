BEGIN;

ALTER TABLE users ADD COLUMN  IF NOT EXISTS first_name CHARACTER VARYING(75);
ALTER TABLE users ADD COLUMN  IF NOT EXISTS last_name CHARACTER VARYING(75);
ALTER TABLE users ADD COLUMN  IF NOT EXISTS organisation CHARACTER VARYING(125);
ALTER TABLE users ADD COLUMN  IF NOT EXISTS function CHARACTER VARYING(75);
ALTER TABLE users ADD COLUMN  IF NOT EXISTS country CHAR(3);

UPDATE users
SET
    first_name = p.first_name,
    last_name = p.last_name,
    organisation = p.organisation,
    function = p.function,
    country = p.country
FROM (
         SELECT id, first_name, last_name, organisation, function, country
         FROM persons ) AS p
WHERE users.person_id = p.id;

-- Remove relations
ALTER TABLE users DROP CONSTRAINT IF EXISTS person_fkey;
ALTER TABLE user_rights DROP CONSTRAINT IF EXISTS user_fkey;
DROP FUNCTION IF EXISTS copy_email();

-- Remove all unnecessary fields & tabels
-- ALTER TABLE users DROP COLUMN IF EXISTS profile_type;
-- ALTER TABLE users DROP COLUMN IF EXISTS person_id;
-- DROP TABLE IF EXISTS persons;
-- DROP TABLE IF EXISTS user_rights;
-- DROP TABLE IF EXISTS user_roles_imet;

COMMIT;
