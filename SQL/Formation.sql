-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 10, 2018 at 09:09 AM
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
-- Table structure for table `Formation`
--

DROP TABLE IF EXISTS `Formation`;
CREATE TABLE `Formation` (
  `AlignementId` int(10) UNSIGNED NOT NULL,
  `EquipeId` int(10) UNSIGNED NOT NULL,
  `JoueurId` int(10) UNSIGNED NOT NULL,
  `PosAbbr` varchar(3) NOT NULL,
  `But` int(2) NOT NULL,
  `Passe` int(11) NOT NULL,
  `Blanchissage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Formation`
--
ALTER TABLE `Alignement`
  ADD PRIMARY KEY (`AlignementId`,`EquipeId`,`JoueurId`),
  ADD KEY `Align_Eqfk` (`EquipeId`),
  ADD KEY `Align_Joufk` (`JoueurId`),
  ADD KEY `Align_Posfk` (`PosAbbr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Formation`
--
ALTER TABLE `Formation`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Formation`
--
ALTER TABLE `Formation`
  ADD CONSTRAINT `Formation_Alifk` FOREIGN KEY (`AlignmentId`) REFERENCES `Alignement` (`id`),
  ADD CONSTRAINT `Formation_Joufk` FOREIGN KEY (`JoueurId`) REFERENCES `Joueur` (`id`),
  ADD CONSTRAINT `Formation_Posfk` FOREIGN KEY (`PosAbbr`) REFERENCES `Position` (`abbr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
