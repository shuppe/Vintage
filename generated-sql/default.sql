
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Alignement
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Alignement`;

CREATE TABLE `Alignement`
(
    `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `EquipeId` int(10) unsigned NOT NULL,
    PRIMARY KEY (`Id`),
    INDEX `Alignement_Eqfk` (`EquipeId`),
    CONSTRAINT `Alignement_Eqfk`
        FOREIGN KEY (`EquipeId`)
        REFERENCES `Equipe` (`id`)
) ENGINE=InnoDB;

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
-- Equipe
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Equipe`;

CREATE TABLE `Equipe`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nom` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Formation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Formation`;

CREATE TABLE `Formation`
(
    `AlignementId` int(10) unsigned NOT NULL,
    `JoueurId` int(10) unsigned NOT NULL,
    `PosAbbr` VARCHAR(3) NOT NULL,
    `But` INTEGER(2) NOT NULL,
    `Passe` INTEGER NOT NULL,
    `Blanchissage` INTEGER NOT NULL,
    PRIMARY KEY (`AlignementId`,`JoueurId`),
    INDEX `Formation_Joufk` (`JoueurId`),
    INDEX `Formation_Posfk` (`PosAbbr`),
    CONSTRAINT `Formation_Alifk`
        FOREIGN KEY (`AlignementId`)
        REFERENCES `Alignement` (`Id`),
    CONSTRAINT `Formation_Joufk`
        FOREIGN KEY (`JoueurId`)
        REFERENCES `Joueur` (`id`),
    CONSTRAINT `Formation_Posfk`
        FOREIGN KEY (`PosAbbr`)
        REFERENCES `Position` (`abbr`)
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
    `Cote` TEXT NOT NULL,
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
    `ArenaNo` int(10) unsigned,
    `EquipeLocale` int(10) unsigned NOT NULL,
    `ptsEquipeLocale` int(3) unsigned,
    `EquipeVisite` int(10) unsigned NOT NULL,
    `ptsEquipeVisite` int(3) unsigned,
    PRIMARY KEY (`id`),
    INDEX `idArena` (`ArenaNo`),
    INDEX `Partie_eqLocFk` (`EquipeLocale`),
    INDEX `Partie_eqVisFk` (`EquipeVisite`),
    CONSTRAINT `Partie_arenafk`
        FOREIGN KEY (`ArenaNo`)
        REFERENCES `Arena` (`id`),
    CONSTRAINT `Partie_eqLocFk`
        FOREIGN KEY (`EquipeLocale`)
        REFERENCES `Alignement` (`Id`),
    CONSTRAINT `Partie_eqVisFk`
        FOREIGN KEY (`EquipeVisite`)
        REFERENCES `Alignement` (`Id`)
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
-- Position_Joueur
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Position_Joueur`;

CREATE TABLE `Position_Joueur`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `idJoueur` int(10) unsigned NOT NULL,
    `abbrPos` VARCHAR(3) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `idJoueur` (`idJoueur`),
    INDEX `abbrPos` (`abbrPos`),
    CONSTRAINT `Position_Joueur_ibfk_1`
        FOREIGN KEY (`idJoueur`)
        REFERENCES `Joueur` (`id`),
    CONSTRAINT `Position_Joueur_ibfk_2`
        FOREIGN KEY (`abbrPos`)
        REFERENCES `Position` (`abbr`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
