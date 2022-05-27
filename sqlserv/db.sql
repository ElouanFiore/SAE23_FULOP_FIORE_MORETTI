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
  `client` int NULL DEFAULT NULL,
  `dispo` boolean NOT NULL, 
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

CREATE USER 'adminMulticast'@'%' IDENTIFIED WITH caching_sha2_password BY 'admin';
GRANT ALL PRIVILEGES ON `multicast`.* TO 'adminMulticast'@'%';

CREATE USER 'web'@'%' IDENTIFIED WITH caching_sha2_password BY 'zj%b6zube^&ajd';
GRANT SELECT, INSERT, UPDATE, DELETE ON `multicast`.* TO 'web'@'%';

CREATE VIEW `multicast`.`ServeursReserve` (IdServeur, Type, CPU, RAM, STOCKAGE, Disponible, Loueur, IdClient) AS SELECT serveurs.id, serveurs.type, serveurs.cpu, serveurs.ram, serveurs.stockage, serveurs.dispo, CONCAT(clients.nom, " ", clients.prenom), clients.id FROM `multicast`.`serveurs`, `multicast`.`clients` WHERE clients.id=serveurs.client;

CREATE VIEW `multicast`.`VueClient` (IdServeur, Type, CPU, RAM, STOCKAGE, mail) AS SELECT serveurs.id, serveurs.type, serveurs.cpu, serveurs.ram, serveurs.stockage, clients.email FROM `multicast`.`serveurs`, `multicast`.`clients`  WHERE serveurs.client=clients.id && serveurs.dispo=1;

INSERT INTO `multicast`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('toto@protonmail.com', SHA1('abcdef'), 'toto', 'toto');
INSERT INTO `multicast`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('tata@gmail.com', SHA1('123456'), 'tata', 'tata');
INSERT INTO `multicast`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('admin@admin.fr', SHA1('admin'), 'admin', 'admin');

INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '8', '128', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '8', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '32', '32', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '32', '256', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '8', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '32', '256', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '32', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '8', '128', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '8', '256', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '8', '32', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '32', '32', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '32', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '16', '32', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '8', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '16', '128', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '8', '32', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '32', '128', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '8', '128', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '32', '128', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '8', '128', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '16', '128', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '8', '32', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '32', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '32', '32', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '16', '32', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '8', '128', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '8', '32', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '8', '256', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '16', '128', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '32', '128', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '16', '32', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '32', '128', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '16', '32', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '8', '256', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '8', '128', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '16', '128', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '16', '32', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '16', '32', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '8', '256', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '32', '256', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '8', '256', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '8', '128', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '16', '256', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '32', '256', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '8', '128', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '8', '256', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '32', '32', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '16', '256', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '32', '32', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '32', '32', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '32', '128', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '32', '256', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '16', '128', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '8', '128', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '32', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '16', '256', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '16', '256', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '32', '128', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '8', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '16', '256', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '8', '32', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '16', '128', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '16', '128', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '16', '32', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '32', '128', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '16', '32', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '32', '128', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '16', '128', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '32', '128', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '16', '256', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '8', '32', '250', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '16', '256', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '32', '256', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '8', '256', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '32', '256', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '16', '32', '2000', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '8', '32', '2000', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '32', '32', '500', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('JEU', '16', '256', '250', 0);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('WEB', '16', '256', '500', 1);
INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('STOCKAGE', '16', '128', '2000', 0);

UPDATE `multicast`.`serveurs` SET `client` = '2' WHERE `serveurs`.`id` = 1;
UPDATE `multicast`.`serveurs` SET `client` = '2' WHERE `serveurs`.`id` = 9;
UPDATE `multicast`.`serveurs` SET `client` = '1' WHERE `serveurs`.`id` = 4;
UPDATE `multicast`.`serveurs` SET `client` = '1' WHERE `serveurs`.`id` = 8;
UPDATE `multicast`.`serveurs` SET `client` = '1' WHERE `serveurs`.`id` = 12;
UPDATE `multicast`.`serveurs` SET `client` = '1' WHERE `serveurs`.`id` = 20;
