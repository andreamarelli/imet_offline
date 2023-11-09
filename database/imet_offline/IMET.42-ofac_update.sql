BEGIN;

-- Rename table to avoid conflicts
ALTER TABLE user_roles RENAME TO user_roles_imet;

COMMIT;