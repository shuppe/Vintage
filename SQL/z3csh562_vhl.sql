-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 10, 2018 at 04:09 PM
-- Server version: 5.6.40-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `z3csh562_vhl`
--

-- --------------------------------------------------------

--
-- Table structure for table `Arena`
--

CREATE TABLE `Arena` (
  `id` int(10) UNSIGNED NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `Ville` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `codePostal` varchar(6) DEFAULT NULL,
  `url` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Arena`
--

INSERT INTO `Arena` (`id`, `Nom`, `adresse`, `Ville`, `province`, `codePostal`, `url`) VALUES
(1, 'Ahuntsic', NULL, 'Montréal', 'Québec', NULL, ''),
(2, 'Marcelin Wilson', NULL, 'Montréal', 'Québec', NULL, ''),
(3, 'Howie Morenz', NULL, 'Montréal', 'Québec', NULL, ''),
(4, 'Normandin', NULL, 'Montréal', 'Québec', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `Equipe`
--

CREATE TABLE `Equipe` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Joueur`
--

CREATE TABLE `Joueur` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `courriel` varchar(100) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `statut` varchar(1) DEFAULT NULL,
  `Cote` text NOT NULL,
  `numero` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Joueur`
--

INSERT INTO `Joueur` (`id`, `nom`, `prenom`, `courriel`, `telephone`, `statut`, `Cote`, `numero`) VALUES
(1, 'Arbour', 'Nicholas', '', '', 'S', '', NULL),
(2, 'Bélanger', 'Jean-Philippe', '', '', 'S', '', NULL),
(3, 'Berndsen', 'Eric', '', '', 'R', '', NULL),
(4, 'Boivin', 'Yannick', '', '', 'R', '', NULL),
(5, 'Boivin', 'Daniel', '', '', 'R', '', NULL),
(6, 'Brouillard', 'Martin', '', '', 'R', '', NULL),
(7, 'Cassivi', 'Luc', '', '', 'R', '', NULL),
(8, 'Cassivi', 'Marc', '', '', 'S', '', NULL),
(9, 'Cockburn', 'Thomas', '', '', 'S', '', NULL),
(10, 'Dumont', 'Luc', '', '', 'R', '', NULL),
(11, 'Fleurent', 'Serge', '', '', 'R', '', NULL),
(12, 'Gignac', 'Benoit', '', '', 'R', '', NULL),
(13, 'Hébert', 'François', '', '', 'R', '', NULL),
(14, 'Huppé', 'Sylvain', '', '', 'R', '', NULL),
(15, 'Lebeuf', 'Eric', '', '', 'R', '', NULL),
(16, 'LeBlanc', 'David', '', '', 'R', '', NULL),
(17, 'Lord', 'Jean-François', '', '', 'R', '', NULL),
(18, 'Mainville', 'Patrick', '', '', 'R', '', NULL),
(19, 'Malkassoff', 'Pierre', '', '', 'R', '', NULL),
(20, 'Marsan', 'Benoit', '', '', 'R', '', NULL),
(21, 'Mercier', 'David', '', '', 'R', '', NULL),
(22, 'Panza', 'Rocco', '', '', 'R', '', NULL),
(23, 'Petelle', 'Thierry', '', '', 'R', '', NULL),
(24, 'Roy', 'Pier-André', '', '', 'S', '', NULL),
(25, 'St-Pierre', 'Marc-François', '', '', 'R', '', NULL),
(26, 'Vallières', 'Nicolas', '', '', 'R', '', NULL),
(27, 'Dumont', 'Louis', '', '', 'R', '', NULL),
(28, 'Doyon', 'Jonathan', '', '', 'S', '', NULL),
(29, 'Dagenais', 'Benoit', '', '', 'S', '', NULL),
(30, 'Lord', 'Sam', '', '', 'S', '', NULL),
(31, 'Malkassoff', 'Nathan', '', '', 'S', '', NULL),
(32, 'Labonté', 'Yves', '', '', 'S', '', NULL),
(33, 'Mainville', 'Fred', '', '', 'S', '', NULL),
(34, 'Chau', 'Frédéric', 'frederic.chau@gmail.com', '5149721093', NULL, '', NULL),
(35, 'Cassivi', 'Hugo', 'hugo.cassivi@gmal.com', '5141234567', NULL, '', NULL),
(36, '', '', '', '', NULL, '', NULL),
(38, '', 'dfw', '', '', 'I', '', NULL),
(39, '', 'scvz', '', '', 'I', '', NULL),
(40, '', 'fg', '', '', 'I', '', NULL),
(41, '', 'fdefvs', '', '', 'I', '', NULL),
(42, '', 'sdfgds', '', '', 'I', '', NULL),
(43, '', 'fsbdv', '', '', 'I', '', NULL),
(44, 'def', 'abc', '', '', 'P', '', NULL),
(45, 'jjerr', 'Abd efG', 'fsabdf', '326354', 'P', '', NULL),
(46, 'fdbsg', 'fdsbg', 'dbsfg', '', 'R', '', NULL),
(47, '', 'dwvwd', '', '', 'I', '', NULL),
(48, '', 'feavfsv', '', '', 'I', '', NULL),
(49, 'dwvafv', 'dsav', 'gsdfhgfs@ewfc.ghf', '756848', 'S', '', NULL),
(50, 'Huppé', 'Sylvain', 'sylvain@3csh.ca', '514-755-9852', 'R', '', NULL),
(51, 'Huppé', 'Sylvain', 'sylvain@3csh.ca', '514-755-9852', 'R', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Partie`
--

CREATE TABLE `Partie` (
  `id` int(10) UNSIGNED NOT NULL,
  `datePartie` date NOT NULL,
  `Heure` time DEFAULT NULL,
  `ArenaNo` int(10) UNSIGNED DEFAULT NULL COMMENT 'id de table Arena',
  `EquipeLocale` int(10) UNSIGNED NOT NULL COMMENT 'id de table Alignement',
  `ptsEquipeLocale` int(3) UNSIGNED DEFAULT NULL,
  `EquipeVisite` int(10) UNSIGNED NOT NULL COMMENT 'id de table Alignement',
  `ptsEquipeVisite` int(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Position`
--

CREATE TABLE `Position` (
  `abbr` varchar(3) NOT NULL,
  `nom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Position`
--

INSERT INTO `Position` (`abbr`, `nom`) VALUES
('A', 'Attaquant'),
('D', 'Défenseur'),
('E', 'Extra'),
('G', 'Gardien');

-- --------------------------------------------------------

--
-- Table structure for table `PositionJoueur`
--

CREATE TABLE `PositionJoueur` (
  `id` int(10) UNSIGNED NOT NULL,
  `idJoueur` int(10) UNSIGNED NOT NULL,
  `abbrPos` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PositionJoueur`
--

INSERT INTO `PositionJoueur` (`id`, `idJoueur`, `abbrPos`) VALUES
(4, 1, 'D'),
(5, 2, 'D'),
(6, 2, 'A'),
(7, 3, 'A'),
(8, 4, 'A'),
(9, 4, 'G'),
(10, 5, 'A'),
(11, 6, 'A'),
(12, 7, 'D'),
(13, 7, 'A'),
(14, 7, 'G'),
(15, 8, 'D'),
(16, 8, 'A'),
(17, 9, 'A'),
(18, 10, 'A'),
(19, 11, 'A'),
(20, 12, 'D'),
(21, 12, 'G'),
(22, 13, 'D'),
(23, 13, 'A'),
(24, 14, 'A'),
(25, 15, 'D'),
(26, 16, 'D'),
(27, 17, 'D'),
(28, 18, 'A'),
(29, 19, 'A'),
(30, 20, 'A'),
(31, 21, 'D'),
(32, 22, 'A'),
(33, 23, 'A'),
(34, 24, 'D'),
(35, 25, 'G'),
(36, 25, 'D'),
(37, 35, 'G'),
(42, 49, 'A'),
(43, 49, 'D'),
(44, 49, 'G'),
(45, 50, 'A'),
(46, 51, 'A'),
(47, 51, 'D'),
(48, 4, 'A'),
(49, 4, 'G'),
(50, 4, 'A'),
(51, 4, 'D'),
(52, 4, 'G'),
(53, 14, 'A'),
(54, 14, 'D'),
(55, 49, 'A'),
(56, 49, 'D'),
(57, 49, 'G'),
(58, 49, 'A'),
(59, 49, 'G'),
(60, 49, 'G');

-- --------------------------------------------------------

--
-- Table structure for table `propel_migration`
--

CREATE TABLE `propel_migration` (
  `version` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Arena`
--
ALTER TABLE `Arena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Joueur`
--
ALTER TABLE `Joueur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Partie`
--
ALTER TABLE `Partie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idArena` (`ArenaNo`),
  ADD KEY `Partie_eqLocFk` (`EquipeLocale`),
  ADD KEY `Partie_eqVisFk` (`EquipeVisite`);

--
-- Indexes for table `Position`
--
ALTER TABLE `Position`
  ADD PRIMARY KEY (`abbr`);

--
-- Indexes for table `PositionJoueur`
--
ALTER TABLE `PositionJoueur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idJoueur` (`idJoueur`),
  ADD KEY `abbrPos` (`abbrPos`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Arena`
--
ALTER TABLE `Arena`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Joueur`
--
ALTER TABLE `Joueur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `Partie`
--
ALTER TABLE `Partie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `PositionJoueur`
--
ALTER TABLE `PositionJoueur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Partie`
--
ALTER TABLE `Partie`
  ADD CONSTRAINT `Partie_arenafk` FOREIGN KEY (`ArenaNo`) REFERENCES `Arena` (`id`),
  ADD CONSTRAINT `Partie_eqLocFk` FOREIGN KEY (`EquipeLocale`) REFERENCES `Alignement` (`Id`),
  ADD CONSTRAINT `Partie_eqVisFk` FOREIGN KEY (`EquipeVisite`) REFERENCES `Alignement` (`Id`);

--
-- Constraints for table `PositionJoueur`
--
ALTER TABLE `PositionJoueur`
  ADD CONSTRAINT `PositionJoueur_ibfk_1` FOREIGN KEY (`idJoueur`) REFERENCES `Joueur` (`id`),
  ADD CONSTRAINT `PositionJoueur_ibfk_2` FOREIGN KEY (`abbrPos`) REFERENCES `Position` (`abbr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
