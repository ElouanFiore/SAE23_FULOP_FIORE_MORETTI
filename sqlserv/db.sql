CREATE DATABASE IF NOT EXISTS `tle`;

CREATE TABLE IF NOT EXISTS `tle`.`serveurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varbinary(10) NOT NULL,
  `cpu` int NOT NULL,
  `ram` int NOT NULL,
  `stockage` int NOT NULL,
  `client` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tle`.`clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varbinary(50) NOT NULL,
  `mdp` varbinary(50) NOT NULL,
  `nom` varbinary(50) NOT NULL,
  `prenom` varbinary(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `tle`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('toto@protonmail.com', SHA1('abcdef'), 'toto', 'TOTO');
INSERT INTO `tle`.`clients` (`email`, `mdp`, `nom`, `prenom`) VALUES ('tata@gmail.com', SHA1('123456'), 'tata', 'TATA');

INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '8', '32', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '128', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '16', '128', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '128', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '256', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '128', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '128', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '128', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '32', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '256', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '256', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '32', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '128', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '256', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '256', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '32', '32', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '32', '128', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '32', '256', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '8', '32', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '256', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '16', '256', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '128', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '32', '128', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '32', '256', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '256', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '32', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '32', '32', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '16', '128', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '32', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '256', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '128', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '128', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '32', '128', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '32', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '32', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '128', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '32', '32', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '32', '256', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '256', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '32', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '32', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '32', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '32', '128', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '32', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '16', '32', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '256', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '128', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '32', '32', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '256', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '128', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '256', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '32', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '32', '128', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '8', '128', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '16', '32', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '32', '32', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '256', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '8', '32', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '32', '256', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '32', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '32', '256', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '128', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '32', '32', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '16', '32', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '32', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '32', '128', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '16', '128', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '32', '256', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '8', '128', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '128', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '8', '128', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('WEB', '16', '256', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '16', '256', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '32', '32', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '8', '128', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '8', '256', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '8', '256', '500');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '16', '256', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '16', '32', '2000');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('STOCKAGE', '8', '256', '250');
INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('JEU', '8', '256', '2000');
