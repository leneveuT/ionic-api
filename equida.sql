-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 26 avr. 2019 à 13:09
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ionequi`
--

-- --------------------------------------------------------

--
-- Structure de la table `cheval`
--

DROP TABLE IF EXISTS `cheval`;
CREATE TABLE IF NOT EXISTS `cheval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `sexe` varchar(1) DEFAULT NULL,
  `prixDepart` int(11) NOT NULL,
  `typecheval` int(11) DEFAULT NULL,
  `clientID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CHEVAL_TYPE` (`typecheval`),
  KEY `clientID` (`clientID`)
) ENGINE=InnoDB AUTO_INCREMENT=5151501 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cheval`
--

INSERT INTO `cheval` (`id`, `nom`, `sexe`, `prixDepart`, `typecheval`, `clientID`) VALUES
(1, 'Valdack', 'M', 10000, 2, 1),
(2, 'Trais d\'or', 'M', 7000, 1, NULL),
(3, 'Herricka', 'F', 56000, 2, NULL),
(4, 'Nuage', 'M', 6500, 1, NULL),
(5, 'Flying fox', 'F', 8000, 3, NULL),
(6, 'rainbow quest', 'F', 58000, 3, NULL),
(7, 'Generous', 'M', 8900, 4, NULL),
(8, 'Gladiateur', 'M', 15000, 3, NULL),
(9, 'California Chrome', 'F', 12700, 2, NULL),
(10, 'Kindjar', 'F', 9500, 3, NULL),
(11, 'Dancing Brave', 'F', 9400, 1, NULL),
(12, 'Linamix', 'M', 72000, 3, NULL),
(13, 'Solow', 'M', 27000, 4, NULL),
(14, 'Kingmambo', 'M', 29450, 1, NULL),
(15, 'Curlin', 'F', 52300, 4, NULL),
(16, 'Dalakni', 'M', 4300, 2, NULL),
(17, 'Dane Dream', 'F', 41000, 4, NULL),
(18, 'Arazi', 'M', 84000, 3, NULL),
(19, 'Black Caviar', 'M', 12450, 3, NULL),
(20, 'Storm Cat', 'F', 24100, 4, NULL),
(25, 'aaaaa', NULL, 0, NULL, NULL),
(27, 'cheval 27', 'M', 0, NULL, NULL),
(48, 'cheval 48', 'M', 22000, NULL, NULL),
(5151500, 'nom', 'M', 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `mail` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `mail`) VALUES
(1, 'ANNOUCHE', 'zannouch@gmail.com'),
(2, 'DUPONT', 'tdupont@wanadoo.fr'),
(3, 'MARIE', 'tony.marie@yahoo.fr'),
(4, 'GARIBALDI', 'lucien.garib@yahoo.fr'),
(5, 'LABILLE', 'Quentin.labille@gmail.com'),
(6, 'BALDI', 'sonia.baldi@yahoo.fr'),
(7, 'MALLET', 'carl.mallet@yahoo.fr');

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `course`
--

INSERT INTO `course` (`id`, `nom`, `lieu`, `date`) VALUES
(1, 'Prix Dahman', 'Dax', '0000-00-00'),
(2, 'prix Dahman', '', '0000-00-00'),
(3, 'Prix Dahman', 'Dax', '2016-09-07'),
(4, 'prix Danbik', 'Aurillac', '2016-08-08'),
(5, 'prix Pierre Pechdo', 'Pompadour', '2016-09-18'),
(6, 'prix d\'Ornano', 'Deauville', '2016-10-02');

-- --------------------------------------------------------

--
-- Structure de la table `resultatcourse`
--

DROP TABLE IF EXISTS `resultatcourse`;
CREATE TABLE IF NOT EXISTS `resultatcourse` (
  `course` int(11) NOT NULL,
  `cheval` int(11) NOT NULL,
  `place` int(11) NOT NULL,
  PRIMARY KEY (`course`,`cheval`),
  KEY `FK_cheval` (`cheval`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resultatcourse`
--

INSERT INTO `resultatcourse` (`course`, `cheval`, `place`) VALUES
(1, 1, 2),
(1, 5, 1),
(1, 17, 4),
(1, 20, 3),
(2, 7, 2),
(2, 13, 3),
(2, 14, 4),
(2, 15, 1),
(3, 1, 4),
(3, 8, 1),
(3, 14, 2),
(3, 19, 3);

-- --------------------------------------------------------

--
-- Structure de la table `typecheval`
--

DROP TABLE IF EXISTS `typecheval`;
CREATE TABLE IF NOT EXISTS `typecheval` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typecheval`
--

INSERT INTO `typecheval` (`id`, `libelle`) VALUES
(1, 'yearling'),
(2, 'pur-sang'),
(3, 'arabe'),
(4, 'trotteur');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cheval`
--
ALTER TABLE `cheval`
  ADD CONSTRAINT `FK_CHEVAL_TYPE` FOREIGN KEY (`typecheval`) REFERENCES `typecheval` (`id`),
  ADD CONSTRAINT `cheval_ibfk_1` FOREIGN KEY (`typecheval`) REFERENCES `typecheval` (`id`),
  ADD CONSTRAINT `cheval_ibfk_2` FOREIGN KEY (`clientID`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `resultatcourse`
--
ALTER TABLE `resultatcourse`
  ADD CONSTRAINT `FK_cheval` FOREIGN KEY (`cheval`) REFERENCES `cheval` (`id`),
  ADD CONSTRAINT `FK_course` FOREIGN KEY (`course`) REFERENCES `course` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
