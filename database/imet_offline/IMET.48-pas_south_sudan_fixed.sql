BEGIN;

-- Add missing country
INSERT into imet.imet_countries VALUES ('SS', 'SSD', 728, 'South Sudan', 'South Sudan', 'South Sudan');

DELETE FROM imet.imet_pas WHERE country = 'SSD';
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '903', 'Southern', 'II', '22800', 'SSD_903');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '904', 'Nimule', 'II', '200', 'SSD_904');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '1368', 'Ez Zeraf', 'VI', '8000', 'SSD_1368');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '1369', 'Kidepo', 'VI', '1200', 'SSD_1369');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '1370', 'Bangangai', 'VI', '170', 'SSD_1370');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '1371', 'Boma', 'II', '20000', 'SSD_1371');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '1372', 'Shambe', 'II', '620', 'SSD_1372');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '1373', 'Ashana', 'VI', '900', 'SSD_1373');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '1374', 'Juba', 'VI', '200', 'SSD_1374');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '1377', 'Mbarizunga', 'VI', '10', 'SSD_1377');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '2337', 'Badingilo', 'II', '16000', 'SSD_2337');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '10735', 'Chelkou', 'VI', '5500', 'SSD_10735');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '10736', 'Boro', 'VI', '1500', 'SSD_10736');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '10737', 'Lantoto', 'II', '760', 'SSD_10737');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '10738', 'Meshra', 'VI', '4500', 'SSD_10738');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '14089', 'Imatong', 'V', '1100', 'SSD_14089');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '555583105', 'Bire Kapatuos', 'VI', '5', 'SSD_555583105');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '555583106', 'Fanyikang', 'VI', '480', 'SSD_555583106');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '555583107', 'Loelle', 'VI', '10963', 'SSD_555583107');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '555583108', 'Boma Extension', 'II', '4887', 'SSD_555583108');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '555583109', 'Nimule Buffer Zone', 'II', '0', 'SSD_555583109');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '555583110', 'Badingilo Extension', 'II', '7724', 'SSD_555583110');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '555583111', 'Numatina', 'VI', '2100', 'SSD_555583111');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '18758', 'Lake Ambadi', 'IV', '1500', 'SSD_18758');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '18759', 'Lake No', 'IV', '1000', 'SSD_18759');
INSERT INTO imet.imet_pas (country, wdpa_id, name, iucn_category, area, global_id) VALUES ('SSD', '18763', 'Lake Abiad', 'IV', '5000', 'SSD_18763');

COMMIT;