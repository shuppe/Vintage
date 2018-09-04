
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Arena
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Arena`;

CREATE TABLE `Arena`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `Nom` VARCHAR(100) NOT NULL,
    `adresse` VARCHAR(200),
    `Ville` VARCHAR(100),
    `province` VARCHAR(100),
    `codePostal` VARCHAR(6),
    `url` VARCHAR(1000) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- CompositionEquipe
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `CompositionEquipe`;

CREATE TABLE `CompositionEquipe`
(
    `id` int(10) unsigned NOT NULL,
    `idEquipe` int(10) unsigned NOT NULL,
    `idJoueur` int(10) unsigned NOT NULL,
    `position` VARCHAR(1) NOT NULL,
    PRIMARY KEY (`id`,`idEquipe`,`idJoueur`),
    UNIQUE INDEX `composition` (`id`, `idEquipe`, `idJoueur`),
    INDEX `idEquipe` (`idEquipe`),
    INDEX `idJoueur` (`idJoueur`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Equipe
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Equipe`;

CREATE TABLE `Equipe`
(
    `id` int(10) unsigned NOT NULL,
    `nom` VARCHAR(50) NOT NULL,
    `couleur` VARCHAR(50) NOT NULL,
    `abbrev` VARCHAR(3) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Joueur
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Joueur`;

CREATE TABLE `Joueur`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(50) NOT NULL,
    `prenom` VARCHAR(50) NOT NULL,
    `courriel` VARCHAR(100),
    `telephone` VARCHAR(15),
    `statut` VARCHAR(1),
    `numero` INTEGER(3),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Partie
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Partie`;

CREATE TABLE `Partie`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `datePartie` DATE NOT NULL,
    `Heure` TIME,
    `idArena` int(10) unsigned,
    `idEquipeLocale` int(10) unsigned NOT NULL,
    `ptsEquipeLocale` int(3) unsigned,
    `idEquipeVisite` int(10) unsigned NOT NULL,
    `ptsEquipeVisite` int(3) unsigned,
    PRIMARY KEY (`id`),
    INDEX `idArena` (`idArena`),
    CONSTRAINT `Partie_ibfk_1`
        FOREIGN KEY (`idArena`)
        REFERENCES `Arena` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Position
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Position`;

CREATE TABLE `Position`
(
    `abbr` VARCHAR(3) NOT NULL,
    `nom` VARCHAR(20),
    PRIMARY KEY (`abbr`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- PositionJoueur
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `PositionJoueur`;

CREATE TABLE `PositionJoueur`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `idJoueur` int(10) unsigned NOT NULL,
    `abbrPos` VARCHAR(3) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `idJoueur` (`idJoueur`),
    INDEX `abbrPos` (`abbrPos`),
    CONSTRAINT `PositionJoueur_ibfk_1`
        FOREIGN KEY (`idJoueur`)
        REFERENCES `Joueur` (`id`),
    CONSTRAINT `PositionJoueur_ibfk_2`
        FOREIGN KEY (`abbrPos`)
        REFERENCES `Position` (`abbr`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
