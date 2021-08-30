create database db_officenotaire;

use db_officenotaire;

CREATE TABLE `dossiers` (
  `id` int(11) NOT NULL auto_increment,
  `date_acte` DATE NOT NULL,
  `nature_acte` VARCHAR(500) NOT NULL,
  `nom_prenom` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
);
CREATE TABLE `d_2001` (
  `id` int(11) NOT NULL auto_increment,
  `date_acte` DATE NOT NULL,
  `nature_acte` VARCHAR(500) NOT NULL,
  `nom_prenom` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
);
========================================

alter table d_2000 add column no_dossier varchar(100);
update d_2000 set no_dossier=concat(id,'/2000');

INSERT INTO d_2000 (date_acte, nature_acte, nom_prenom, no_dossier) SELECT date_acte, nature_acte, nom_prenom, no_dossier  FROM d_2001;

delimiter #
create trigger update_no_dossier
    before insert on d_2000
    for each row 
    begin
     declare idnosplit varchar(45);
     declare idint int;
     declare storedyear varchar(10);
     declare storedyearInt int;
     declare cyear int;
     declare idsplit varchar(45);
     declare vara varchar(45);

     set @cyear := (select CAST(YEAR(CURDATE()) as UNSIGNED));
     set @idnosplit := (select no_dossier from d_2000 order by id desc limit 1);
     set @idsplit := (select substring_index (@idnosplit,'/',1) as STRING);
     set @storedyear := (select substring_index (@idnosplit,'/',-1) as STRING);
     set @storedyearInt := (select CAST(@storedyear as UNSIGNED));

    IF (@storedyearInt < @cyear) THEN
     set @idint := 1;
     set @idsplit := (select CAST(@idint as CHAR(45)));
     set @vara := (select CAST(@storedyearInt + 1 as CHAR(45)));
     END IF;

     IF (@storedyearInt = @cyear) THEN
     set @idint := (select CAST(@idsplit as UNSIGNED)) + 1;
     set @idsplit := (select CAST(@idint as CHAR(45)));
     set @vara := (select CAST(@cyear as CHAR(45)));
     END IF;

     SET NEW.no_dossier = concat(@idsplit, '/', @vara);
    end#
delimiter;


