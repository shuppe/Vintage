-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 01 Mai 2015 à 17:20
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `z3csh562_poolhockey`
--

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

CREATE TABLE IF NOT EXISTS `resultat` (
`id` int(10) unsigned NOT NULL,
  `annee` int(11) NOT NULL,
  `Ronde` int(11) NOT NULL,
  `idEquipe1` int(11) NOT NULL,
  `idEquipe2` int(11) NOT NULL,
  `gagnant` int(11) DEFAULT NULL COMMENT 'id de la table Equipe',
  `matches` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `resultat`
--

INSERT INTO `resultat` (`id`, `annee`, `Ronde`, `idEquipe1`, `idEquipe2`, `gagnant`, `matches`) VALUES
(1, 2015, 1, 8, 11, 8, 5),
(2, 2015, 1, 6, 10, 6, 6),
(3, 2015, 1, 13, 4, NULL, NULL),
(4, 2015, 1, 15, 9, 15, 7),
(5, 2015, 1, 1, 16, 1, 4),
(6, 2015, 1, 12, 5, 5, 6),
(7, 2015, 1, 7, 3, 3, 6),
(8, 2015, 1, 14, 2, 2, 6);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `resultat`
--
ALTER TABLE `resultat`
 ADD PRIMARY KEY (`id`), ADD KEY `idEquipe1` (`idEquipe1`), ADD KEY `idEquipe2` (`idEquipe2`), ADD KEY `gagnant` (`gagnant`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `resultat`
--
ALTER TABLE `resultat`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
