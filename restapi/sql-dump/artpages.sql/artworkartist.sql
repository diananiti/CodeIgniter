-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Aug 2015 la 11:18
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
-- Structura de tabel pentru tabelul `artworkartist`
--

CREATE TABLE IF NOT EXISTS `artworkartist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `artist_id` int(10) NOT NULL,
  `artwork_id` int(10) NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Salvarea datelor din tabel `artworkartist`
--

INSERT INTO `artworkartist` (`id`, `user_id`, `artist_id`, `artwork_id`, `datecreated`, `dateupdated`) VALUES
(9, 13, 59, 21, '2015-08-26 11:47:31', '2015-08-26 11:47:31'),
(10, 13, 56, 21, '2015-08-26 11:47:31', '2015-08-26 11:47:31'),
(11, 13, 48, 21, '2015-08-26 11:47:31', '2015-08-26 11:47:31'),
(12, 13, 58, 21, '2015-08-26 11:47:52', '2015-08-26 11:47:52');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
