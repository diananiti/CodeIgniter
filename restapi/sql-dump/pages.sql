-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Sep 2015 la 09:13
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `restapi`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Salvarea datelor din tabel `pages`
--

INSERT INTO `pages` (`id`, `user_id`, `slug`, `title`, `content`, `datecreated`, `dateupdated`) VALUES
(42, 13, 'frontend', 'home', 'The home page for the website<br>', '2015-09-04 09:11:39', '2015-09-04 09:11:39'),
(43, 13, 'artist', 'Artist', 'Artists<br>', '2015-09-04 09:18:41', '2015-09-04 09:18:41'),
(47, 13, 'contact', 'contact', 'dasdas<br>', '2015-09-07 09:31:10', '2015-09-07 09:31:10'),
(48, 13, 'artwork', 'artwork', 'Artwork page', '2015-09-07 09:54:27', '2015-09-07 09:54:27'),
(49, 13, 'pages', 'pages', 'pages page<br>', '2015-09-07 12:47:26', '2015-09-07 12:47:26'),
(50, 13, 'frontend/artist_search', 'Search', 'Search for artists in DB<br>', '2015-09-08 10:05:38', '2015-09-08 10:05:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
