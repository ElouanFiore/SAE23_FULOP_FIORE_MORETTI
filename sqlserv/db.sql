DROP DATABASE IF EXISTS `multicast`;
DROP USER IF EXISTS `adminMulticast`;
DROP USER IF EXISTS `web`;

CREATE DATABASE `multicast`;

CREATE TABLE `multicast`.`serveurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varbinary(10) NOT NULL,
  `cpu` int NOT NULL,
  `ram` int NOT NULL,
  `stockage` int NOT NULL,
  `idLocation` int NULL DEFAULT NULL,
  `enService` boolean NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `multicast`.`clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varbinary(50) NOT NULL,
  `mdp` varbinary(50) NOT NULL,
  `nom` varbinary(50) NOT NULL,
  `prenom` varbinary(50) NOT NULL,
  `actif` boolean NOT NULL DEFAULT 1, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `multicast`.`locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idClient` int NOT NULL,
  `idServeur` int NOT NULL,
  `debutLoc` DATETIME NOT NULL,
  `finLoc` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE USER 'adminMulticast'@'%' IDENTIFIED WITH caching_sha2_password BY 'admin';
GRANT ALL PRIVILEGES ON `multicast`.* TO 'adminMulticast'@'%';

CREATE USER 'web'@'%' IDENTIFIED WITH caching_sha2_password BY 'zj%b6zube^&ajd';
GRANT SELECT, INSERT, UPDATE, DELETE ON `multicast`.* TO 'web'@'%';

CREATE VIEW `multicast`.`ServeursReserve` (idLocation, Début, Fin, IdServeur, Type, CPU, RAM, STOCKAGE, idClient, mail, nom, prenom) AS SELECT locations.id, locations.debutLoc, locations.finLoc, serveurs.id, serveurs.type, serveurs.cpu, serveurs.ram, serveurs.stockage, clients.id, clients.email, clients.nom, clients.prenom FROM `multicast`.`serveurs`, `multicast`.`locations`, `multicast`.`clients` WHERE serveurs.id=locations.idServeur && clients.id=locations.idClient && serveurs.enService=1 && locations.finLoc IS NULL;

CREATE VIEW `multicast`.`VueClient` (ID, Début, Fin, IdServeur, Type, CPU, RAM, STOCKAGE, enService, mail) AS SELECT locations.id, locations.debutLoc, locations.finLoc, serveurs.id, serveurs.type, serveurs.cpu, serveurs.ram, serveurs.stockage, serveurs.enService, clients.email FROM `multicast`.`serveurs`, `multicast`.`locations`, `multicast`.`clients` WHERE serveurs.id=locations.idServeur && clients.id=locations.idClient;

CREATE VIEW `multicast`.`ServeursDispo` (IdServeur, Type, CPU, RAM, STOCKAGE) AS SELECT serveurs.id, serveurs.type, serveurs.cpu, serveurs.ram, serveurs.stockage FROM `multicast`.`serveurs` WHERE serveurs.idLocation IS NULL && serveurs.enService=1;

INSERT INTO `multicast`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('admin', SHA1('admin'), 'admin', 'admin');
INSERT INTO `multicast`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('toto@protonmail.com', SHA1('abcdef'), 'toto', 'toto');
INSERT INTO `multicast`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('tata@gmail.com', SHA1('123456'), 'tata', 'tata');

INSERT INTO `multicast`.`locations` (`idClient`, `idServeur`, `debutLoc`) VALUES (2, 23, CURRENT_TIMESTAMP);
INSERT INTO `multicast`.`locations` (`idClient`, `idServeur`, `debutLoc`) VALUES (2, 20, CURRENT_TIMESTAMP);
INSERT INTO `multicast`.`locations` (`idClient`, `idServeur`, `debutLoc`) VALUES (2, 1, CURRENT_TIMESTAMP);
INSERT INTO `multicast`.`locations` (`idClient`, `idServeur`, `debutLoc`) VALUES (3, 8, CURRENT_TIMESTAMP);
INSERT INTO `multicast`.`locations` (`idClient`, `idServeur`, `debutLoc`) VALUES (3, 30, CURRENT_TIMESTAMP);
INSERT INTO `multicast`.`locations` (`idClient`, `idServeur`, `debutLoc`) VALUES (3, 5, CURRENT_TIMESTAMP);
INSERT INTO `multicast`.`locations` (`idClient`, `idServeur`, `debutLoc`, `finLoc`) VALUES (2, 13, "2022-05-20 10:00:00", CURRENT_TIMESTAMP);

INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '16', '128', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '8', '32', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '8', '128', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '8', '256', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '32', '128', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '8', '32', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '32', '256', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '16', '256', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '16', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '8', '128', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '8', '32', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '8', '32', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '8', '32', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '8', '128', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '32', '32', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '8', '256', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '16', '256', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '8', '128', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '8', '128', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '8', '256', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '32', '128', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '128', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '8', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '8', '128', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '32', '32', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '32', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '16', '256', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '256', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '8', '128', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '32', '128', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '128', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '32', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '128', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '32', '32', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '128', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '32', '256', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '16', '32', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '32', '32', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '256', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '8', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '16', '128', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '16', '128', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '256', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '32', '256', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '16', '256', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '8', '256', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '16', '128', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '8', '32', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '256', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '16', '128', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '16', '32', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '8', '128', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '16', '256', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '32', '256', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '32', '256', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '8', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '8', '256', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '32', '32', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '32', '256', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '128', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '32', '128', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '16', '32', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '8', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '16', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '8', '32', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '8', '256', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '8', '128', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('WEB', '32', '128', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '16', '128', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '32', '32', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '16', '32', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '8', '256', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '16', '32', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '16', '32', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '128', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('STOCKAGE', '32', '128', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('JEU', '32', '32', '250', 0);
UPDATE `multicast`.`serveurs`, `multicast`.`locations` SET serveurs.idLocation=locations.id, serveurs.enService=1 WHERE serveurs.id=locations.idServeur && locations.finLoc IS NULL;
