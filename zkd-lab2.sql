-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Računalo: localhost
-- Vrijeme generiranja: Ožu 31, 2015 u 01:02 PM
-- Verzija poslužitelja: 5.6.11-log
-- PHP verzija: 5.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza podataka: `zkd`
--
CREATE DATABASE IF NOT EXISTS `zkd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `zkd`;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `alergeni`
--

CREATE TABLE IF NOT EXISTS `alergeni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=11 ;

--
-- Izbacivanje podataka za tablicu `alergeni`
--

INSERT INTO `alergeni` (`id`, `naziv`) VALUES
(1, 'soja'),
(2, 'jaja'),
(3, 'kikiriki'),
(4, 'mlijeko'),
(5, 'rakovi'),
(6, 'školjke'),
(7, 'orašasti plodovi'),
(8, 'jagode'),
(9, 'kivi'),
(10, 'ananas');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `alergeni_u_proizvodu`
--

CREATE TABLE IF NOT EXISTS `alergeni_u_proizvodu` (
  `id_proizvoda` int(11) NOT NULL,
  `id_alergena` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Izbacivanje podataka za tablicu `alergeni_u_proizvodu`
--

INSERT INTO `alergeni_u_proizvodu` (`id_proizvoda`, `id_alergena`) VALUES
(1, 2),
(1, 7),
(2, 2),
(2, 4),
(3, 2),
(5, 2),
(28, 7),
(21, 5),
(12, 6),
(25, 1),
(17, 3),
(29, 1),
(19, 4),
(14, 3),
(14, 6),
(33, 8),
(25, 2),
(33, 10),
(30, 2),
(23, 10),
(23, 3),
(30, 10),
(16, 6),
(36, 7),
(8, 1),
(22, 6),
(7, 10),
(14, 8),
(25, 7),
(18, 9),
(8, 4),
(36, 2),
(31, 10),
(13, 8),
(18, 7),
(7, 4),
(14, 7),
(19, 9),
(35, 5),
(26, 1),
(29, 6),
(11, 3),
(20, 7),
(17, 4),
(36, 6),
(10, 7),
(30, 9),
(26, 10),
(7, 6),
(20, 8),
(37, 2),
(18, 3),
(37, 7),
(12, 5),
(35, 8),
(28, 8),
(24, 2),
(11, 5),
(23, 8),
(26, 5),
(27, 5);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `proizvodi`
--

CREATE TABLE IF NOT EXISTS `proizvodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `tip` int(11) NOT NULL,
  `opis` text COLLATE utf8_general_ci,
  `vegetarijanski` tinyint(1) NOT NULL,
  `halal` tinyint(1) NOT NULL,
  `koser` tinyint(1) NOT NULL,
  `cijena` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=38 ;

--
-- Izbacivanje podataka za tablicu `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `naziv`, `tip`, `opis`, `vegetarijanski`, `halal`, `koser`, `cijena`) VALUES
(1, 'Gibanica', 6, 'Ovo je slani tip 1a, punjena je orasima', 0, 0, 0, '10'),
(2, 'Sirnica', 6, 'Ovo je slani tip 1a, punjen sirom', 0, 0, 0, '12'),
(3, 'Burek', 6, 'Ovo je slani tip 1a, punjen mesom', 0, 0, 0, '14'),
(4, 'Sacher 2', 1, 'Čokoladna 2 u više slojeva', 1, 1, 1, '16'),
(5, 'Mađarica', 1, 'Čokoladni tip torte u više slojeva, s korama', 0, 0, 0, '10'),
(6, 'Kremšnita', 1, '', 0, 1, 1, '3'),
(7, 'Šampita', 1, '', 0, 0, 0, '8'),
(8, 'Piškote', 3, '', 0, 0, 1, '49'),
(9, 'Čokoladni 3i – čisti', 3, '', 1, 0, 0, '14'),
(10, 'Čokoladni 3i – brusnice', 3, '', 1, 0, 0, '30'),
(11, 'Voćni kup', 1, '', 0, 0, 0, '2'),
(12, 'Čokolada s čilijem', 4, '', 0, 0, 0, '35'),
(13, 'Čokolada s citrusnim aromama', 4, '', 1, 0, 0, '4'),
(14, 'Belgijske praline', 4, '', 0, 0, 1, '31'),
(15, 'Praline s konjakom', 4, '', 0, 0, 0, '13'),
(16, 'Macarons', 3, 'nekakvi 3i', 0, 0, 0, '3'),
(17, 'Croisant', 6, '', 0, 0, 0, '42'),
(18, 'Banana split', 1, '', 0, 0, 0, '14'),
(19, 'Ganache 2', 2, '', 1, 0, 0, '25'),
(20, 'ZKD 2', 2, '', 0, 0, 1, '47'),
(21, 'Voćna 2', 2, '', 0, 1, 1, '26'),
(22, 'Tiramisu', 1, '', 0, 0, 1, '43'),
(23, 'Crne kocke', 1, '', 0, 1, 0, '7'),
(24, 'Kesten štapić', 1, '', 1, 0, 1, '41'),
(25, 'Kesten šnita', 1, '', 0, 0, 0, '31'),
(26, 'Kokos štangice', 3, '', 0, 0, 0, '6'),
(27, 'Palice', 3, '', 1, 0, 0, '2'),
(28, 'Bananko', 1, '', 0, 1, 0, '3'),
(29, 'Breskvice', 3, '', 0, 0, 0, '48'),
(30, 'Čupavci', 1, '', 0, 0, 0, '2'),
(31, 'Čokoladni mousse', 1, '', 0, 0, 0, '31'),
(32, 'Išler', 1, '', 0, 0, 0, '8'),
(33, 'Lambada', 1, '', 1, 1, 1, '43'),
(34, 'Medenjaci', 3, '', 0, 0, 0, '47'),
(35, 'Rafaelo kuglice', 1, '', 0, 0, 0, '4'),
(36, 'Šubare', 1, '', 1, 0, 0, '43'),
(37, 'Iločki Traminac', 5, '', 1, 0, 0, '8');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `tip_proizvoda`
--

CREATE TABLE IF NOT EXISTS `tip_proizvoda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=7 ;

--
-- Izbacivanje podataka za tablicu `tip_proizvoda`
--

INSERT INTO `tip_proizvoda` (`id`, `naziv`) VALUES
(1, 'kolač'),
(2, 'torta'),
(3, 'keks'),
(4, 'čokolada'),
(5, 'piće'),
(6, 'ostalo');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=3 ;

--
-- Izbacivanje podataka za tablicu `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`) VALUES
(1, 1, 'isinek', '8fe2b8a4c448693a8140a54b91cba9a7'),
(2, 2, 'Gost', '29531b875d246284dd84bdb7ade9aea0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
