-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 11 Septembre 2017 à 23:30
-- Version du serveur :  5.6.35-log
-- Version de PHP :  5.6.30

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `z3csh562_vhl`
--

-- --------------------------------------------------------
DROP TABLE IF EXISTS `Arena`;
DROP TABLE IF EXISTS `CompositionEquipe`;
DROP TABLE IF EXISTS `Equipe`;
DROP TABLE IF EXISTS `Joueur`;
DROP TABLE IF EXISTS `Partie`;
DROP TABLE IF EXISTS `Position`;
DROP TABLE IF EXISTS `PositionJoueur`;

--
-- Structure de la table `Arena`
--

DROP TABLE IF EXISTS `Arena`;
CREATE TABLE IF NOT EXISTS `Arena` (
  `id` int(10) UNSIGNED NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `Ville` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `codePostal` varchar(6) DEFAULT NULL,
  `url` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `CompositionEquipe`
--

DROP TABLE IF EXISTS `CompositionEquipe`;
CREATE TABLE IF NOT EXISTS `CompositionEquipe` (
  `id` int(10) UNSIGNED NOT NULL,
  `idEquipe` int(10) UNSIGNED NOT NULL,
  `idJoueur` int(10) UNSIGNED NOT NULL,
  `position` varchar(1) NOT NULL,
  PRIMARY KEY (`id`,`idEquipe`,`idJoueur`),
  UNIQUE KEY `id` (`id`),
  KEY `idEquipe` (`idEquipe`),
  KEY `idJoueur` (`idJoueur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Equipe`
--

DROP TABLE IF EXISTS `Equipe`;
CREATE TABLE IF NOT EXISTS `Equipe` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `abbrev` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Equipe`
--

INSERT INTO `Equipe` (`id`, `nom`, `couleur`, `abbrev`) VALUES
(1, 'Pâles', 'Blanc', 'P'),
(2, 'Foncés', 'Noir', 'F');

-- --------------------------------------------------------

--
-- Structure de la table `Joueur`
--

DROP TABLE IF EXISTS `Joueur`;
CREATE TABLE IF NOT EXISTS `Joueur` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `courriel` varchar(100) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `statut` varchar(1) DEFAULT NULL,
  `numero` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Joueur`
--

INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (1,'Nicholas', 'Arbour', '', '', 'S');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (2,'Jean-Philippe', 'Bélanger', '', '', 'S');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (3,'Eric', 'Berndsen', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (4,'Yannick', 'Boivin', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (5,'Daniel', 'Boivin', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (6,'Martin', 'Brouillard', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (7,'Luc', 'Cassivi', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (8,'Marc', 'Cassivi', '', '', 'S');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (9,'Thomas', 'Cockburn', '', '', 'S');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (10,'Luc', 'Dumont', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (11,'Serge', 'Fleurent', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (12,'Benoit', 'Gignac', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (13,'François', 'Hébert', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (14,'Sylvain', 'Huppé', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (15,'Eric', 'Lebeuf', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (16,'Dave', 'LeBlanc', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (17,'Jean-François', 'Lord', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (18,'Patrick', 'Mainville', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (19,'Pierre', 'Malkassoff', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (20,'Benoit', 'Marsan', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (21,'David', 'Mercier', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (22,'Rocco', 'Panza', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (23,'Thierry', 'Petelle', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (24,'Pier-André', 'Roy', '', '', 'S');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (25,'Marc-François', 'St-Pierre', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (26,'Nicolas', 'Vallières', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (27,'Louis', 'Dumont', '', '', 'R');
INSERT into `Joueur` (`id`,`prenom`, `nom`, `courriel`, `telephone`, `statut`) values (28,'Jonathan', '', '', '', 'S');
-- --------------------------------------------------------

--
-- Structure de la table `Partie`
--

DROP TABLE IF EXISTS `Partie`;
CREATE TABLE IF NOT EXISTS `Partie` (
  `id` int(10) UNSIGNED NOT NULL,
  `datePartie` date NOT NULL,
  `Heure` time DEFAULT NULL,
  `idArena` int(10) UNSIGNED DEFAULT NULL COMMENT 'id de table Arena',
  `idEquipeLocale` int(10) UNSIGNED NOT NULL COMMENT 'id de table compositionÉquipe',
  `ptsEquipeLocale` int(3) UNSIGNED DEFAULT NULL,
  `idEquipeVisite` int(10) UNSIGNED NOT NULL COMMENT 'id de table compositionÉquipe',
  `ptsEquipeVisite` int(3) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idArena` (`idArena`),
  KEY `idEquipeLocale` (`idEquipeLocale`),
  KEY `idEquipeVisite` (`idEquipeVisite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Position`
--

DROP TABLE IF EXISTS `Position`;
CREATE TABLE IF NOT EXISTS `Position` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(3) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `PositionJoueur`
--

DROP TABLE IF EXISTS `PositionJoueur`;
CREATE TABLE IF NOT EXISTS `PositionJoueur` (
  `id` int(10) UNSIGNED NOT NULL,
  `idJoueur` int(10) UNSIGNED NOT NULL,
  `idPosition` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idJoueur` (`idJoueur`),
  KEY `idPosition` (`idPosition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `CompositionEquipe`
--
-- ALTER TABLE `CompositionEquipe`
--   ADD CONSTRAINT `CompositionEquipe_ibfk_1` FOREIGN KEY (`idEquipe`) REFERENCES `Equipe` (`id`),
--   ADD CONSTRAINT `CompositionEquipe_ibfk_2` FOREIGN KEY (`idJoueur`) REFERENCES `Joueur` (`id`);

--
-- Contraintes pour la table `Partie`
--
ALTER TABLE `Partie`
  ADD CONSTRAINT `Partie_ibfk_1` FOREIGN KEY (`idArena`) REFERENCES `Arena` (`id`),
  ADD CONSTRAINT `Partie_ibfk_2` FOREIGN KEY (`idEquipeLocale`) REFERENCES `CompositionEquipe` (`id`),
  ADD CONSTRAINT `Partie_ibfk_3` FOREIGN KEY (`idEquipeVisite`) REFERENCES `CompositionEquipe` (`id`);

--
-- Contraintes pour la table `PositionJoueur`
--
ALTER TABLE `PositionJoueur`
  ADD CONSTRAINT `PositionJoueur_ibfk_1` FOREIGN KEY (`idJoueur`) REFERENCES `Joueur` (`id`),
  ADD CONSTRAINT `PositionJoueur_ibfk_2` FOREIGN KEY (`idPosition`) REFERENCES `Position` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
