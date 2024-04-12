BEGIN;

CREATE TABLE imet.imet_regions
(
    id      varchar(2) PRIMARY KEY,
    name    text,
    name_fr text,
    name_sp text,
    name_pt text
);

ALTER TABLE imet.imet_countries ADD COLUMN IF NOT EXISTS "region_id" varchar(2) default null;
ALTER TABLE  imet.imet_countries ADD CONSTRAINT fk_region_id FOREIGN KEY (region_id) REFERENCES imet.imet_regions(id) ON DELETE CASCADE;

INSERT INTO imet.imet_regions VALUES ('sa', 'Southern Africa', 'Southern Africa', 'Southern Africa', 'Southern Africa');
INSERT INTO imet.imet_regions VALUES ('wa', 'Western Africa', 'Western Africa', 'Western Africa', 'Western Africa');
INSERT INTO imet.imet_regions VALUES ('ca', 'Central Africa', 'Central Africa', 'Central Africa', 'Central Africa');
INSERT INTO imet.imet_regions VALUES ('ea', 'Eastern Africa', 'Eastern Africa', 'Eastern Africa', 'Eastern Africa');
INSERT INTO imet.imet_regions VALUES ('ap', 'ACP Pacific', 'ACP Pacific', 'ACP Pacific', 'ACP Pacific');
INSERT INTO imet.imet_regions VALUES ('ac', 'ACP Caribbean', 'ACP Caribbean', 'ACP Caribbean', 'ACP Caribbean');

UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  710;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  24;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  28;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  44;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  52;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  84;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  20;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  72;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  85;
UPDATE imet.imet_countries SET region_id = 'ca' WHERE iso =  10;
UPDATE imet.imet_countries SET region_id = 'ca' WHERE iso =  120;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  132;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  174;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  384;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  192;
UPDATE imet.imet_countries SET region_id = 'ea' WHERE iso =  262;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  212;
UPDATE imet.imet_countries SET region_id = 'ea' WHERE iso =  232;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  583;
UPDATE imet.imet_countries SET region_id = 'ea' WHERE iso =  231;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  242;
UPDATE imet.imet_countries SET region_id = 'ca' WHERE iso =  266;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  270;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  288;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  308;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  324;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  624;
UPDATE imet.imet_countries SET region_id = 'ca' WHERE iso =  226;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  328;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  254;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  332;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  184;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  584;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  90;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  388;
UPDATE imet.imet_countries SET region_id = 'ea' WHERE iso =  404;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  296;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  426;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  430;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  450;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  454;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  466;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  480;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  478;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  508;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  516;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  520;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  562;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  566;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  570;
UPDATE imet.imet_countries SET region_id = 'ea' WHERE iso =  800;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  585;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  598;
UPDATE imet.imet_countries SET region_id = 'ca' WHERE iso =  140;
UPDATE imet.imet_countries SET region_id = 'ca' WHERE iso =  180;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  214;
UPDATE imet.imet_countries SET region_id = 'ca' WHERE iso =  178;
UPDATE imet.imet_countries SET region_id = 'ea' WHERE iso =  834;
UPDATE imet.imet_countries SET region_id = 'ea' WHERE iso =  646;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  662;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  659;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  670;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  882;
UPDATE imet.imet_countries SET region_id = 'ca' WHERE iso =  678;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  686;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  690;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  694;
UPDATE imet.imet_countries SET region_id = 'ea' WHERE iso =  706;
UPDATE imet.imet_countries SET region_id = 'ea' WHERE iso =  729;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  740;
UPDATE imet.imet_countries SET region_id = 'ca' WHERE iso =  148;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  626;
UPDATE imet.imet_countries SET region_id = 'wa' WHERE iso =  768;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  776;
UPDATE imet.imet_countries SET region_id = 'ac' WHERE iso =  780;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  798;
UPDATE imet.imet_countries SET region_id = 'ap' WHERE iso =  548;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  894;
UPDATE imet.imet_countries SET region_id = 'sa' WHERE iso =  716;

COMMIT;
