DROP TABLE IF EXISTS `db_FIORE`.`serveurs`;
DROP TABLE IF EXISTS `db_FIORE`.`clients`;
DROP TABLE IF EXISTS `db_FIORE`.`locations`;
DROP VIEW IF EXISTS `db_FIORE`.`ServeursReserve`;
DROP VIEW IF EXISTS `db_FIORE`.`ServeursLibre`;
DROP VIEW IF EXISTS `db_FIORE`.`VueClient`;

CREATE TABLE `db_FIORE`.`serveurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varbinary(10) NOT NULL,
  `cpu` int NOT NULL,
  `ram` int NOT NULL,
  `stockage` int NOT NULL,
  `idLocation` int NULL DEFAULT NULL,
  `enService` boolean NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE = MyISAM;

CREATE TABLE `db_FIORE`.`clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varbinary(50) NOT NULL,
  `mdp` varbinary(50) NOT NULL,
  `nom` varbinary(50) NOT NULL,
  `prenom` varbinary(50) NOT NULL,
  `actif` boolean NOT NULL DEFAULT 1, 
  PRIMARY KEY (`id`)
) ENGINE = MyISAM;

CREATE TABLE `db_FIORE`.`locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idClient` int NOT NULL,
  `idServeur` int NOT NULL,
  `debutLoc` DATETIME NOT NULL,
  `finLoc` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MyISAM;

CREATE VIEW `db_FIORE`.`ServeursReserve` (idLocation, Début, Fin, IdServeur, Type, CPU, RAM, STOCKAGE, idClient, mail, nom, prenom) AS SELECT locations.id, locations.debutLoc, locations.finLoc, serveurs.id, serveurs.type, serveurs.cpu, serveurs.ram, serveurs.stockage, clients.id, clients.email, clients.nom, clients.prenom FROM `db_FIORE`.`serveurs`, `db_FIORE`.`locations`, `db_FIORE`.`clients` WHERE serveurs.id=locations.idServeur && clients.id=locations.idClient && serveurs.enService=1 && locations.finLoc IS NULL;

CREATE VIEW `db_FIORE`.`VueClient` (ID, Début, Fin, IdServeur, Type, CPU, RAM, STOCKAGE, enService, mail) AS SELECT locations.id, locations.debutLoc, locations.finLoc, serveurs.id, serveurs.type, serveurs.cpu, serveurs.ram, serveurs.stockage, serveurs.enService, clients.email FROM `db_FIORE`.`serveurs`, `db_FIORE`.`locations`, `db_FIORE`.`clients` WHERE serveurs.id=locations.idServeur && clients.id=locations.idClient;

CREATE VIEW `db_FIORE`.`ServeursDispo` (IdServeur, Type, CPU, RAM, STOCKAGE) AS SELECT serveurs.id, serveurs.type, serveurs.cpu, serveurs.ram, serveurs.stockage FROM `db_FIORE`.`serveurs` WHERE serveurs.idLocation IS NULL && serveurs.enService=1;

INSERT INTO `db_FIORE`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('admin', SHA1('admin'), 'admin', 'admin');
INSERT INTO `db_FIORE`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('toto@protonmail.com', SHA1('abcdef'), 'toto', 'toto');
INSERT INTO `db_FIORE`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('tata@gmail.com', SHA1('123456'), 'tata', 'tata');

INSERT INTO `db_FIORE`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '256', '100', '0');
INSERT INTO `db_FIORE`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '128', '4000', '0');
INSERT INTO `db_FIORE`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '128', '50');
INSERT INTO `db_FIORE`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '128', '200');
INSERT INTO `db_FIORE`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '256', '200');
INSERT INTO `db_FIORE`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '32', '40');
INSERT INTO `db_FIORE`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '32', '4000');
INSERT INTO `db_FIORE`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '32', '10');

INSERT INTO `db_FIORE`.`locations` (`idClient`, `idServeur`, `debutLoc`, `finLoc`) VALUES (2, 1, '2021-12-01 09:14:04', '2022-04-01 09:34:02');
INSERT INTO `db_FIORE`.`locations` (`idClient`, `idServeur`, `debutLoc`, `finLoc`) VALUES (3, 2, '2021-12-02 20:45:33', '2021-12-11 11:09:22');
INSERT INTO `db_FIORE`.`locations` (`idClient`, `idServeur`, `debutLoc`) VALUES (2, 4, '2022-04-01 09:45:58');
INSERT INTO `db_FIORE`.`locations` (`idClient`, `idServeur`, `debutLoc`) VALUES (3, 3, '2022-06-01 17:31:01');
INSERT INTO `db_FIORE`.`locations` (`idClient`, `idServeur`, `debutLoc`) VALUES (2, 7, '2022-06-05 11:00:47');

UPDATE `db_FIORE`.`serveurs`, `db_FIORE`.`locations` SET serveurs.idLocation=locations.id, serveurs.enService=1 WHERE serveurs.id=locations.idServeur && locations.finLoc IS NULL;
