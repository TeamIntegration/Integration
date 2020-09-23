-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 17 sep. 2020 à 23:52
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `integration`
--

-- --------------------------------------------------------

--
-- Structure de la table `1sio`
--

DROP TABLE IF EXISTS `1sio`;
CREATE TABLE IF NOT EXISTS `1sio` (
  `idEtudiant` int(11) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  PRIMARY KEY (`idEtudiant`,`idEquipe`),
  KEY `contrainte_idEquipe1sio` (`idEquipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `2sio`
--

DROP TABLE IF EXISTS `2sio`;
CREATE TABLE IF NOT EXISTS `2sio` (
  `idEtudiant` int(11) NOT NULL,
  PRIMARY KEY (`idEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `accompagner`
--

DROP TABLE IF EXISTS `accompagner`;
CREATE TABLE IF NOT EXISTS `accompagner` (
  `idEtudiant` int(11) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  PRIMARY KEY (`idEtudiant`,`idEquipe`),
  KEY `contrainte_idEquipeAccompagner` (`idEquipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE IF NOT EXISTS `activite` (
  `idActivite` int(11) NOT NULL AUTO_INCREMENT,
  `libelleActivite` varchar(255) NOT NULL,
  `lieuActivite` varchar(255) NOT NULL,
  PRIMARY KEY (`idActivite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `idEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `nomEquipe` varchar(255) DEFAULT NULL,
  `scoreEquipe` int(255) DEFAULT NULL,
  PRIMARY KEY (`idEquipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `idEtudiant` int(11) NOT NULL AUTO_INCREMENT,
  `nomEtudiant` varchar(255) NOT NULL,
  `prenomEtudiant` varchar(255) NOT NULL,
  `emailEtudiant` varchar(255) NOT NULL,
  `loginEtudiant` varchar(255) NOT NULL,
  `passwordEtudiant` varchar(255) NOT NULL,
  PRIMARY KEY (`idEtudiant`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gerer`
--

DROP TABLE IF EXISTS `gerer`;
CREATE TABLE IF NOT EXISTS `gerer` (
  `idEtudiant` int(11) NOT NULL,
  `idActivite` int(11) NOT NULL,
  `activiteFini` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEtudiant`,`idActivite`),
  KEY `idActivite` (`idActivite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `idEquipe` int(11) NOT NULL,
  `idActivite` int(11) NOT NULL,
  `tour` int(11) NOT NULL,
  `effectuer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEquipe`,`idActivite`),
  KEY `contrainte_idActivitePartciper` (`idActivite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `1sio`
--
ALTER TABLE `1sio`
  ADD CONSTRAINT `contrainte_idEquipe1sio` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contrainte_idEtudiant1sio` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiant` (`idEtudiant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `2sio`
--
ALTER TABLE `2sio`
  ADD CONSTRAINT `contrainte_idEtudiant2sio` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiant` (`idEtudiant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `accompagner`
--
ALTER TABLE `accompagner`
  ADD CONSTRAINT `contrainte_idEquipeAccompagner` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contrainte_idEtudiantAccompagner` FOREIGN KEY (`idEtudiant`) REFERENCES `2sio` (`idEtudiant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD CONSTRAINT `contrainte_idEtudiantGerer` FOREIGN KEY (`idEtudiant`) REFERENCES `2sio` (`idEtudiant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gerer_ibfk_1` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `contrainte_idActivitePartciper` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contrainte_idEquipePartciper` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
