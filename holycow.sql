-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 26 Août 2013 à 21:32
-- Version du serveur: 5.5.28
-- Version de PHP: 5.4.4-9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `holycow`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `commandeid` int(11) NOT NULL AUTO_INCREMENT,
  `livraisonid` int(11) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`commandeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `commandes`
--

INSERT INTO `commandes` (`commandeid`, `livraisonid`, `contact`, `details`, `prix`) VALUES
(1, 3, 'hjk', 'hjk', 0),
(2, 3, 'hjk', 'hjk', 0),
(3, 3, 'jkl', 'jkl', 0),
(4, 5, 'ddfg', 'dfg', 0),
(5, 5, 'ddfg', 'dfg', 2.5),
(6, 5, 'ddfg', 'dfg', 2.5),
(7, 5, 'ddfg', 'dfg', 2.5);

-- --------------------------------------------------------

--
-- Structure de la table `livraisons`
--

CREATE TABLE IF NOT EXISTS `livraisons` (
  `livraisonid` int(11) NOT NULL AUTO_INCREMENT,
  `datelivraison` datetime DEFAULT NULL,
  `datedernierdelai` datetime DEFAULT NULL,
  `actif` tinyint(1) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  KEY `id` (`livraisonid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `livraisons`
--

INSERT INTO `livraisons` (`livraisonid`, `datelivraison`, `datedernierdelai`, `actif`, `contact`) VALUES
(1, '2015-05-05 11:01:06', '2015-05-05 11:01:06', 1, 'qsd@qsd'),
(2, '2012-05-05 11:01:06', '2012-05-05 11:01:06', 7, 'qsd@qsd'),
(3, '2013-03-23 12:20:00', '2013-03-23 11:00:00', 1, 'qsd@qsd.comtggg'),
(4, '2013-03-24 03:02:39', '2013-03-24 03:02:39', 1, 'qsd@qsdbind'),
(5, '2013-03-24 10:27:58', '2013-03-24 10:27:58', 0, 'sdf@sdf.sd'),
(6, '2013-03-24 10:34:39', '2013-03-24 10:34:39', 0, 'sdf@sdf.sdlol'),
(7, '2013-03-28 12:20:00', '2013-03-28 12:20:00', 0, 'sdf@sdf.sdloluuu'),
(8, '2013-03-24 12:20:00', '2013-03-24 12:20:00', 0, 'jkljkl');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
