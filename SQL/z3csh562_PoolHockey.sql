-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Client :  www.3csh.ca
-- Généré le :  Mar 28 Avril 2015 Ã  04:45
-- Version du serveur :  5.5.40-cll
-- Version de PHP :  5.4.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `z3csh562_PoolHockey`
--
CREATE DATABASE IF NOT EXISTS `z3csh562_PoolHockey` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `z3csh562_PoolHockey`;

-- --------------------------------------------------------

--
-- Structure de la table `Equipe`
--

DROP TABLE IF EXISTS `Equipe`;
CREATE TABLE IF NOT EXISTS `Equipe` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `abbrev` varchar(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Equipe`
--

INSERT INTO `Equipe` (`id`, `nom`, `ville`, `abbrev`) VALUES
(1, 'Ducks', 'Anaheim', 'ANA'),
(2, 'Flames', 'Calgary', 'CGY'),
(3, 'Black Hawks', 'Chicago', 'CHI'),
(4, 'Red Wings', 'Detroit', 'DET'),
(5, 'Wild', 'Minessota', 'MIN'),
(6, 'Canadiens', 'Montreal', 'MTL'),
(7, 'Predateurs', 'Nashville', 'NAS'),
(8, 'Rangers', 'New York', 'NYR'),
(9, 'Islanders', 'New York', 'NYI'),
(10, 'Senateurs', 'Ottawa', 'OTT'),
(11, 'Pingouins', 'Pittsburg', 'PIT'),
(12, 'Blues', 'St-Louis', 'STL'),
(13, 'Lightning', 'Tampa Bay', 'TB'),
(14, 'Canucks', 'Vancouver', 'VAN'),
(15, 'Capitals', 'Washington', 'WAS'),
(16, 'Jets', 'Winnipeg', 'WPG');

-- --------------------------------------------------------

--
-- Structure de la table `Participant`
--

DROP TABLE IF EXISTS `Participant`;
CREATE TABLE IF NOT EXISTS `Participant` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `courriel` varchar(100) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Participant`
--

INSERT INTO `Participant` (`id`, `nom`, `prenom`, `courriel`, `telephone`) VALUES
(1, 'Barry', 'Vincent', 'vbarry@gmail.com', NULL),
(2, 'Beaudoin', 'Francis', 'ledome27@gmail.com', NULL),
(3, 'Bellavance', 'Louis', 'louis.bellavance@intact.net', NULL),
(4, 'Bouchard', 'Mario', 'mario.bouchard@me.com', NULL),
(5, 'Chau', 'Fred', 'frederic.chau@intact.net', NULL),
(6, 'Deslandes', 'Pierre', 'pierre.deslandes@intact.net', NULL),
(7, 'Gagnon', 'Guy', 'guygag@gmail.com', NULL),
(8, 'Huppé', 'Sylvain', 'sylvain@3csh.ca', NULL),
(9, 'Jutras', 'André', 'ajjutras@gmail.com', NULL),
(10, 'Lefebvre', 'Yvon', 'yvon.lefebvre@intact.net', NULL),
(11, 'Legault', 'Jacques', 'jacques.legault@desjardins.com', NULL),
(12, 'Mainville', 'Fred', 'frederick.mainville@scd.desjardins.com', NULL),
(13, 'Morin', 'Benoît', 'ben.morin@videotron.ca', NULL),
(14, 'Parent', 'André', 'aparent@lcci.qc.ca', NULL),
(15, 'Piette', 'Luc', 'lpiette@groupeedc.com', NULL),
(16, 'Roy', 'Guy', 'guy_sixpack@yahoo.fr', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Prediction`
--

DROP TABLE IF EXISTS `Prediction`;
CREATE TABLE IF NOT EXISTS `Prediction` (
  `id` int(10) unsigned NOT NULL,
  `annee` int(11) NOT NULL,
  `Ronde` int(11) NOT NULL,
  `idParticipant` int(11) NOT NULL COMMENT 'id de table Participant',
  `serieNo` int(11) NOT NULL,
  `idgagnant` int(11) NOT NULL COMMENT 'id de table équipe',
  `nombreParties` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Prediction`
--

INSERT INTO `Prediction` (`id`, `annee`, `Ronde`, `idParticipant`, `serieNo`, `idgagnant`, `nombreParties`) VALUES
(1, 2015, 1, 1, 1, 8, 5),
(2, 2015, 1, 1, 2, 6, 6),
(3, 2015, 1, 1, 3, 13, 5),
(4, 2015, 1, 1, 4, 15, 6),
(5, 2015, 1, 1, 5, 1, 7),
(6, 2015, 1, 1, 6, 12, 6),
(7, 2015, 1, 1, 7, 3, 6),
(8, 2015, 1, 1, 8, 14, 6),
(9, 2015, 1, 2, 1, 8, 6),
(10, 2015, 1, 2, 2, 6, 5),
(11, 2015, 1, 2, 3, 13, 7),
(12, 2015, 1, 2, 4, 15, 6),
(13, 2015, 1, 2, 5, 1, 5),
(14, 2015, 1, 2, 6, 12, 6),
(15, 2015, 1, 2, 7, 3, 7),
(16, 2015, 1, 2, 8, 14, 6),
(17, 2015, 1, 3, 1, 8, 5),
(18, 2015, 1, 3, 2, 6, 6),
(19, 2015, 1, 3, 3, 4, 6),
(20, 2015, 1, 3, 4, 15, 6),
(21, 2015, 1, 3, 5, 1, 5),
(22, 2015, 1, 3, 6, 5, 6),
(23, 2015, 1, 3, 7, 3, 6),
(24, 2015, 1, 3, 8, 2, 6),
(25, 2015, 1, 4, 1, 8, 5),
(26, 2015, 1, 4, 2, 6, 7),
(27, 2015, 1, 4, 3, 13, 5),
(28, 2015, 1, 4, 4, 9, 7),
(29, 2015, 1, 4, 5, 16, 6),
(30, 2015, 1, 4, 6, 5, 6),
(31, 2015, 1, 4, 7, 3, 7),
(32, 2015, 1, 4, 8, 2, 7),
(33, 2015, 1, 5, 1, 8, 6),
(34, 2015, 1, 5, 2, 6, 7),
(35, 2015, 1, 5, 3, 13, 5),
(36, 2015, 1, 5, 4, 15, 6),
(37, 2015, 1, 5, 5, 1, 6),
(38, 2015, 1, 5, 6, 12, 7),
(39, 2015, 1, 5, 7, 3, 7),
(40, 2015, 1, 5, 8, 2, 6),
(41, 2015, 1, 6, 1, 8, 5),
(42, 2015, 1, 6, 2, 10, 6),
(43, 2015, 1, 6, 3, 13, 5),
(44, 2015, 1, 6, 4, 15, 7),
(45, 2015, 1, 6, 5, 1, 6),
(46, 2015, 1, 6, 6, 12, 5),
(47, 2015, 1, 6, 7, 3, 5),
(48, 2015, 1, 6, 8, 14, 6),
(49, 2015, 1, 7, 1, 8, 7),
(50, 2015, 1, 7, 2, 6, 6),
(51, 2015, 1, 7, 3, 13, 5),
(52, 2015, 1, 7, 4, 15, 6),
(53, 2015, 1, 7, 5, 1, 5),
(54, 2015, 1, 7, 6, 12, 7),
(55, 2015, 1, 7, 7, 3, 6),
(56, 2015, 1, 7, 8, 2, 6),
(57, 2015, 1, 8, 1, 8, 6),
(58, 2015, 1, 8, 2, 6, 6),
(59, 2015, 1, 8, 3, 13, 5),
(60, 2015, 1, 8, 4, 9, 7),
(61, 2015, 1, 8, 5, 16, 7),
(62, 2015, 1, 8, 6, 12, 6),
(63, 2015, 1, 8, 7, 7, 7),
(64, 2015, 1, 8, 8, 2, 5),
(65, 2015, 1, 9, 1, 8, 6),
(66, 2015, 1, 9, 2, 6, 6),
(67, 2015, 1, 9, 3, 13, 5),
(68, 2015, 1, 9, 4, 9, 7),
(69, 2015, 1, 9, 5, 1, 6),
(70, 2015, 1, 9, 6, 5, 7),
(71, 2015, 1, 9, 7, 3, 7),
(72, 2015, 1, 9, 8, 2, 6),
(73, 2015, 1, 10, 1, 8, 5),
(74, 2015, 1, 10, 2, 6, 6),
(75, 2015, 1, 10, 3, 13, 4),
(76, 2015, 1, 10, 4, 15, 6),
(77, 2015, 1, 10, 5, 1, 6),
(78, 2015, 1, 10, 6, 5, 6),
(79, 2015, 1, 10, 7, 3, 7),
(80, 2015, 1, 10, 8, 14, 6),
(81, 2015, 1, 11, 1, 8, 6),
(82, 2015, 1, 11, 2, 6, 5),
(83, 2015, 1, 11, 3, 13, 5),
(84, 2015, 1, 11, 4, 9, 6),
(85, 2015, 1, 11, 5, 1, 6),
(86, 2015, 1, 11, 6, 12, 5),
(87, 2015, 1, 11, 7, 7, 6),
(88, 2015, 1, 11, 8, 2, 6),
(89, 2015, 1, 12, 1, 8, 5),
(90, 2015, 1, 12, 2, 6, 6),
(91, 2015, 1, 12, 3, 13, 7),
(92, 2015, 1, 12, 4, 9, 6),
(93, 2015, 1, 12, 5, 1, 6),
(94, 2015, 1, 12, 6, 12, 5),
(95, 2015, 1, 12, 7, 3, 6),
(96, 2015, 1, 12, 8, 14, 7),
(97, 2015, 1, 13, 1, 8, 6),
(98, 2015, 1, 13, 2, 10, 7),
(99, 2015, 1, 13, 3, 13, 6),
(100, 2015, 1, 13, 4, 9, 7),
(101, 2015, 1, 13, 5, 16, 7),
(102, 2015, 1, 13, 6, 12, 5),
(103, 2015, 1, 13, 7, 7, 6),
(104, 2015, 1, 13, 8, 2, 7),
(105, 2015, 1, 14, 1, 8, 4),
(106, 2015, 1, 14, 2, 6, 7),
(107, 2015, 1, 14, 3, 13, 6),
(108, 2015, 1, 14, 4, 9, 6),
(109, 2015, 1, 14, 5, 1, 6),
(110, 2015, 1, 14, 6, 12, 5),
(111, 2015, 1, 14, 7, 3, 6),
(112, 2015, 1, 14, 8, 2, 7),
(113, 2015, 1, 15, 1, 8, 5),
(114, 2015, 1, 15, 2, 6, 7),
(115, 2015, 1, 15, 3, 13, 5),
(116, 2015, 1, 15, 4, 15, 7),
(117, 2015, 1, 15, 5, 1, 6),
(118, 2015, 1, 15, 6, 5, 7),
(119, 2015, 1, 15, 7, 3, 6),
(120, 2015, 1, 15, 8, 2, 7),
(121, 2015, 1, 16, 1, 8, 5),
(122, 2015, 1, 16, 2, 6, 7),
(123, 2015, 1, 16, 3, 13, 6),
(124, 2015, 1, 16, 4, 15, 6),
(125, 2015, 1, 16, 5, 1, 6),
(126, 2015, 1, 16, 6, 12, 7),
(127, 2015, 1, 16, 7, 3, 7),
(128, 2015, 1, 16, 8, 2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `Resultat`
--

DROP TABLE IF EXISTS `Resultat`;
CREATE TABLE IF NOT EXISTS `Resultat` (
  `id` int(10) unsigned NOT NULL,
  `annee` int(11) NOT NULL,
  `ronde` int(11) NOT NULL,
  `serieNo` int(11) NOT NULL,
  `idEquipe1` int(11) NOT NULL,
  `idEquipe2` int(11) NOT NULL,
  `gagnant` int(11) DEFAULT NULL COMMENT 'id de la table Equipe',
  `matches` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Resultat`
--

INSERT INTO `Resultat` (`id`, `annee`, `ronde`, `serieNo`, `idEquipe1`, `idEquipe2`, `gagnant`, `matches`) VALUES
(1, 2015, 1, 1, 8, 11, 8, 5),
(2, 2015, 1, 2, 6, 10, 6, 6),
(3, 2015, 1, 3, 13, 4, NULL, NULL),
(4, 2015, 1, 4, 15, 9, 15, 7),
(5, 2015, 1, 5, 1, 16, 1, 4),
(6, 2015, 1, 6, 12, 5, 5, 6),
(7, 2015, 1, 7, 7, 3, 3, 6),
(8, 2015, 1, 8, 14, 2, 2, 6),
(9, 2015, 2, 1, 8, 15, NULL, NULL),
(10, 2015, 2, 2, 6, 4, NULL, NULL),
(11, 2015, 2, 3, 1, 2, NULL, NULL),
(12, 2015, 2, 4, 3, 5, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Participant`
--
ALTER TABLE `Participant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Prediction`
--
ALTER TABLE `Prediction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idParticipant` (`idParticipant`),
  ADD KEY `idgagnant` (`idgagnant`);

--
-- Index pour la table `Resultat`
--
ALTER TABLE `Resultat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEquipe1` (`idEquipe1`),
  ADD KEY `idEquipe2` (`idEquipe2`),
  ADD KEY `gagnant` (`gagnant`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `Participant`
--
ALTER TABLE `Participant`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `Prediction`
--
ALTER TABLE `Prediction`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT pour la table `Resultat`
--
ALTER TABLE `Resultat`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

select Concat(Participant.prenom, " ", Participant.nom) NomP,
Prediction.Ronde,
Prediction.serieNo,
Equipe.abbrev, 
Prediction.nombreParties
from Participant, Equipe, Prediction
where Prediction.idParticipant = Participant.id
and Prediction.idgagnant = Equipe.id;