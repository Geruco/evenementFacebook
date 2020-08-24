-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 24, 2020 at 10:00 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soirees`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `writer_id` int(255) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `content` text NOT NULL,
  `rating` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `writer_id` (`writer_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `writer_id`, `receiver_id`, `content`, `rating`, `date`) VALUES
(1, 1, 6, 'Soirée pas fun', 2, '2020-08-13 09:33:00'),
(2, 6, 1, 'Super', 5, '2020-08-14 22:16:30'),
(3, 6, 1, 'bof', 1, '2020-08-14 23:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcer_id` int(11) NOT NULL,
  `secondPerson_id` int(11) NOT NULL,
  `starting_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `announcer_id` (`announcer_id`),
  KEY `secondPerson_id` (`secondPerson_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
CREATE TABLE IF NOT EXISTS `demandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asker_id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `party_id` (`party_id`),
  KEY `asker_id` (`asker_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

DROP TABLE IF EXISTS `parties`;
CREATE TABLE IF NOT EXISTS `parties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `nb_of_people` int(11) NOT NULL,
  `places_reserved` int(11) NOT NULL DEFAULT 0,
  `cash` int(11) NOT NULL,
  `age_moyen` int(11) NOT NULL,
  `alcool` tinyint(1) NOT NULL DEFAULT 0,
  `musique` tinyint(1) NOT NULL DEFAULT 0,
  `costumes` tinyint(1) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `starting_hour` time NOT NULL,
  `posting_datetime` datetime NOT NULL DEFAULT '2020-01-01 00:00:00',
  `adresse` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `announcer_id` (`announcer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `announcer_id`, `date`, `nb_of_people`, `places_reserved`, `cash`, `age_moyen`, `alcool`, `musique`, `costumes`, `description`, `starting_hour`, `posting_datetime`, `adresse`, `city`, `postal_code`, `country`) VALUES
(1, 1, '2020-08-18', 3, 3, 20, 18, 0, 0, 0, 'Tout sera beau !', '16:00:00', '2020-08-14 06:50:00', 'rue du colonel moutarde', 'Arcachon', 0, 'France'),
(4, 1, '2020-08-13', 4, 0, 10, 32, 0, 0, 0, ' No description', '19:36:00', '2020-01-01 00:00:00', '42 nop', 'Ahahah', 56566, 'France');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'defaultPicture.png',
  `sexe` int(255) NOT NULL DEFAULT 3,
  `birthdate` date DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `Apropos` text NOT NULL DEFAULT 'blank',
  `role` int(255) NOT NULL COMMENT '0 = user, 1 = modo, 2 = admin',
  `inscription_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nickname`, `password`, `picture`, `sexe`, `birthdate`, `mail`, `Apropos`, `role`, `inscription_date`) VALUES
(1, 'Geruco', '$2y$10$YyI3V.MpmMmvjFQsQYjPlOGm6Q5dLdbgvrvyuziXH/0QBZUnMbAHC', 'defaultPicture.png', 1, '1999-05-18', 'random.org@gmail.com', 'blank', 2, '2020-08-12'),
(4, 'admin', '$2y$10$9V8a0au90erELSe8ZmvyI.6Fie1nC7.//LLoF3NKPgEF5BF5R2ZCu', 'defaultPicture.png', 3, NULL, 'random.org@gmail.com', 'blank', 2, '2020-08-13'),
(6, 'test', '$2y$10$/Mes3.J6V.5IazMKDI.A/e7akinBnDJ8O4fdORNVuouDoh8kc70me', 'defaultPicture.png', 1, '2009-05-13', 'random@gmail.com', 'blank 222', 0, '2020-08-13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
