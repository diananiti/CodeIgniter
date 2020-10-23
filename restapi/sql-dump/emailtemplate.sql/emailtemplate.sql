-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2015 at 02:16 PM
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
-- Table structure for table `emailtemplate`
--

CREATE TABLE IF NOT EXISTS `emailtemplate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `emailtemplate`
--

INSERT INTO `emailtemplate` (`id`, `user_id`, `slug`, `title`, `content`, `datecreated`, `dateupdated`) VALUES
(9, 4, 'ss', 'sdgs', 'sdfs', '2015-08-22 00:00:00', '2015-08-13 00:00:00'),
(10, 5, 'fs', 'sfsf', 'sdf', '2015-08-22 00:00:00', '2015-08-27 00:00:00'),
(11, 5, 'dfgf', 'sfs', 'sdffsd', '2015-08-27 00:00:00', '2015-08-12 00:00:00'),
(12, 7, 'ch', 'cffg', 'xbx', '2015-08-29 00:00:00', '2015-08-14 00:00:00'),
(13, 8, 'fg', 'cgh', 'cvbvcb', '2015-08-20 00:00:00', '2015-08-20 00:00:00'),
(14, 9, 'cgh', 'ch', 'cbcvb', '2015-08-12 00:00:00', '2015-08-27 00:00:00'),
(15, 10, 'c', 'cgxfg', 'xgx', '2015-08-27 00:00:00', '2015-08-13 00:00:00'),
(16, 11, 'df', 'zdf', 'zddf', '2015-08-20 00:00:00', '2015-08-21 00:00:00'),
(17, 12, 'fdf', 'sdf', 'sdf', '2015-08-27 00:00:00', '2015-08-28 00:00:00'),
(18, 13, 'sdf', 'sdf', 'sdfs', '2015-08-27 00:00:00', '2015-08-13 00:00:00'),
(19, 14, 'sd', 'sdf', 'sdfsdf', '2015-08-27 00:00:00', '2015-08-27 00:00:00'),
(20, 15, 'er', 'erer', 'erewer', '2015-08-27 00:00:00', '2015-08-21 00:00:00'),
(24, 16, 'gggg', 'ggsd', 'df', '2015-08-20 00:00:00', '2015-08-18 00:00:00'),
(25, 17, 'fg', 'fg', 'gsdgg', '2015-08-20 00:00:00', '2015-08-28 00:00:00'),
(26, 18, 'dfg', 'fg', 'fgdfg', '2015-08-27 00:00:00', '2015-08-20 00:00:00'),
(27, 19, 'h', 'fgd', 'fgdfg', '2015-08-19 00:00:00', '2015-08-13 00:00:00'),
(28, 20, 'vgh', 'gch', 'fhfh', '2015-08-27 00:00:00', '2015-08-12 00:00:00'),
(29, 21, 'zd', 'a', 'asfasf', '2015-08-27 00:00:00', '2015-08-28 00:00:00'),
(30, 22, 'xdf', 'df', 'afas', '2015-08-19 00:00:00', '2015-08-13 00:00:00'),
(31, 23, 'xdf', 'zdf', 'zdf', '2015-08-13 00:00:00', '2015-08-07 00:00:00'),
(32, 24, 'sd', 'sdf', 'zdf', '2015-08-29 00:00:00', '2015-08-28 00:00:00'),
(34, NULL, 'as', 'asa', 'asasaad', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
