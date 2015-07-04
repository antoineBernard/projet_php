-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Sam 04 Juillet 2015 à 08:20
-- Version du serveur: 5.5.41-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ProjetWeb`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `Date_commentaire` date DEFAULT NULL,
  `ID_jeu` int(11) NOT NULL,
  `Pseudo_utilisateur` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Commentaire` mediumtext CHARACTER SET utf8 NOT NULL,
  `Note` int(2) NOT NULL,
  PRIMARY KEY (`ID_commentaire`),
  KEY `ID_jeu` (`ID_jeu`),
  KEY `Pseudo_utilisateur` (`Pseudo_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=33 ;


-- --------------------------------------------------------

--
-- Structure de la table `editeurs`
--

CREATE TABLE IF NOT EXISTS `editeurs` (
  `Editeur` varchar(60) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Editeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `Genre` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `genres`
--

INSERT INTO `genres` (`Genre`) VALUES
('Action'),
('Aventure'),
('FPS'),
('Jeu de rôles'),
('Plate-formes'),
('Réflexion'),
('Simulation'),
('Stratégie'),
('Survie');

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE IF NOT EXISTS `jeux` (
  `ID_jeu` int(6) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(40) CHARACTER SET utf8 NOT NULL,
  `Sortie` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Nom_studio` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Editeur` varchar(60) CHARACTER SET utf8 NOT NULL,
  `Genre` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Univers` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Note_redaction` int(2) NOT NULL,
  `Note` decimal(3,1) NOT NULL,
  `Description` longtext CHARACTER SET utf8 NOT NULL,
  `Test` longtext CHARACTER SET utf8 NOT NULL,
  `Nombre_notes` int(11) NOT NULL,
  `Nomine` int(1) NOT NULL DEFAULT '0',
  `Jeu_mois` int(1) NOT NULL DEFAULT '0',
  `Jeu_semaine` int(1) NOT NULL DEFAULT '0',
  `Jaquette` varchar(300) NOT NULL,
  PRIMARY KEY (`ID_jeu`),
  KEY `Nom_studio` (`Nom_studio`),
  KEY `Genre` (`Genre`),
  KEY `Univers` (`Univers`),
  KEY `Editeur` (`Editeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=49 ;


--
-- Structure de la table `proposition_jeux`
--

CREATE TABLE IF NOT EXISTS `proposition_jeux` (
  `ID_proposition` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_contributeur` varchar(40) NOT NULL,
  `Jeu` varchar(40) NOT NULL,
  `Studio` varchar(40) NOT NULL,
  `Genre` varchar(40) NOT NULL,
  `Adresse_email` int(30) NOT NULL,
  `Message_contributeur` varchar(600) NOT NULL,
  `Date_proposition` date DEFAULT NULL,
  `traite` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_proposition`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;


-- --------------------------------------------------------

--
-- Structure de la table `studios`
--

CREATE TABLE IF NOT EXISTS `studios` (
  `Nom_studio` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Annee_creation` int(4) NOT NULL,
  PRIMARY KEY (`Nom_studio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Structure de la table `univers`
--

CREATE TABLE IF NOT EXISTS `univers` (
  `Univers` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Univers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `univers`
--

INSERT INTO `univers` (`Univers`) VALUES
('Contemporain'),
('Fantastique'),
('Historique'),
('Horreur'),
('Science-fiction'),
('Steampunk');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `Pseudonyme` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Mot_de_passe` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Adresse_email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Date_inscription` date NOT NULL,
  `url_avatar` varchar(50) NOT NULL DEFAULT 'Images/default-avatar.png',
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Pseudonyme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Pseudonyme`, `Mot_de_passe`, `Adresse_email`, `Date_inscription`, `url_avatar`, `Admin`) VALUES
('antoine', '$2y$10$9rMTtNVJYYbX4/meg3S4Xe8Y/gzCp7avPxxudFYXfX5cMAWQ5hr16', 'abern@gmail.com', '2015-07-01', 'Images/avatar-masque-a-gaz.jpg', 1),



--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_pseudo_utilisateur_FK` FOREIGN KEY (`Pseudo_utilisateur`) REFERENCES `utilisateurs` (`Pseudonyme`),
  ADD CONSTRAINT `commenaire_ID_jeu_FK` FOREIGN KEY (`ID_jeu`) REFERENCES `jeux` (`ID_jeu`);

--
-- Contraintes pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `jeux_editeur_FK` FOREIGN KEY (`Editeur`) REFERENCES `editeurs` (`Editeur`),
  ADD CONSTRAINT `jeux_genre_FK` FOREIGN KEY (`Genre`) REFERENCES `genres` (`Genre`),
  ADD CONSTRAINT `jeux_nom_studio_FK` FOREIGN KEY (`Nom_studio`) REFERENCES `studios` (`Nom_studio`),
  ADD CONSTRAINT `jeux_univers_FK` FOREIGN KEY (`Univers`) REFERENCES `univers` (`Univers`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
