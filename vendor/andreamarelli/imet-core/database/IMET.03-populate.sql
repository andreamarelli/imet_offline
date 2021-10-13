BEGIN;
INSERT INTO persons (id, first_name, last_name) VALUES (0, 'Offline', 'User');
INSERT INTO users (id, person_id) VALUES (0, 0);
INSERT INTO user_roles_imet(id, user_id, role) VALUES (0, 0, 'encoder');
COMMIT;
