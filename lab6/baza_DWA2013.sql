-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2013 at 11:35 PM
-- Server version: 5.1.69
-- PHP Version: 5.3.6-13ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `DWA2015`
--

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE IF NOT EXISTS `vijesti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `title`, `author`, `text`, `date`) VALUES
(1, 'Naslov prve vijesti koji je jako dugačak', 'Stipe', 'Ovo je prva vijest koja je meni izrazito zanimljiva. Naslov je jako dugačak. S obzirom kako volimo dugačke vijesti, sve što ne stane mora biti skraćeno, ali to ovdje odrađujemo na serverskoj strani. Ali kako onda napraviti da se sve ipak ispiše? Koristeći Silexov router koji će sve ispravno pospajati.', '2013-05-01'),
(4, 'Druga vijest', 'Stipe', 'Ovo je druga vijest. Tek toliko da imamo još koju vijest', '2013-05-08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
