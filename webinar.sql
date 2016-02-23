# SQL Manager 2007 for MySQL 4.1.2.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : webinar


SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `webinar`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `webinar`;

#
# Structure for the `eventos` table : 
#

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_evento` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `titulo_evento` varchar(200) DEFAULT NULL,
  `descricao_evento` longtext,
  `aovivo` tinyint(4) DEFAULT '0',
  `concluido` tinyint(4) DEFAULT '0',
  `src_evento` varchar(200) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT '0',
  `bg_play` varchar(250) DEFAULT NULL,
  `banner` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Structure for the `lista` table : 
#

CREATE TABLE `lista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `obs` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

#
# Structure for the `webinar` table : 
#

CREATE TABLE `webinar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `mensagem` longtext,
  `evento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for the `eventos` table  (LIMIT 0,500)
#

INSERT INTO `eventos` (`id`, `data_evento`, `titulo_evento`, `descricao_evento`, `aovivo`, `concluido`, `src_evento`, `ativo`, `bg_play`, `banner`) VALUES 
  (1,'2015-08-25 22:00:00','1º HANGOUT - XTREME SECURITY','Social Enginnering - Face to Face Exploitation\r\ncom Anderson Tamborim',1,0,'https://www.youtube.com/embed/gEPmA3USJdI',1,'bg_play.jpg','banner_xtreme.jpg');

COMMIT;

