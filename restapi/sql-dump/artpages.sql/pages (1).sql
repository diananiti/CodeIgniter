-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2015 at 08:47 AM
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
-- Table structure for table `pages`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `user_id`, `slug`, `title`, `content`, `datecreated`, `dateupdated`) VALUES
(15, 1, 'fasda', 'asda', 'fasda', '2015-08-17 10:10:56', '2015-08-17 10:10:56'),
(16, 1, 'wad', 'wdw', 'wd', '2015-08-17 10:18:42', '2015-08-17 10:18:42'),
(17, 1, 'wd', 'dw', 'wdd', '2015-08-18 10:11:55', '2015-08-18 10:11:55'),
(18, 1, 'werewr', 'werwer', 'www', '2015-08-18 10:12:59', '2015-08-18 10:12:59'),
(19, 1, 'aaaaa', 'bbbb', 'dddd', '2015-08-18 10:13:28', '2015-08-18 10:13:28'),
(20, 1, 'ytryr', 'ryry', 'tert', '2015-08-18 10:38:00', '2015-08-18 10:38:00'),
(21, 1, 'eqwe', 'wqeqwe', 'qweqweqw', '2015-08-18 10:56:35', '2015-08-18 10:56:35'),
(22, 1, 'gyvfghb', 'h h', 'n', '2015-08-18 11:22:49', '2015-08-18 11:22:49'),
(23, 1, 'gy', 'bhbh', 'hbhb', '2015-08-18 11:23:17', '2015-08-18 11:23:17'),
(24, 1, 'qwed', 'adw', 'wdawd', '2015-08-18 12:22:08', '2015-08-18 12:22:08'),
(25, 1, 'eqwe', 'wqeqwe', 'weqwdewqeweqweqwe', '2015-08-18 12:27:19', '2015-08-18 12:27:19'),
(26, 1, 'dadad', 'dadadad', 'dada', '2015-08-18 12:31:21', '2015-08-18 12:31:21'),
(27, 1, 'wdqw', 'qwdqw', 'qwdqwd', '2015-08-18 12:31:49', '2015-08-18 12:31:49'),
(28, 1, 'qweqwe', 'wewqe', 'we', '2015-08-19 09:32:19', '2015-08-19 09:32:19'),
(29, 1, 'EWEWE', 'WEW', 'WEQE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 1, 'WDWDWDFfefsfsfsdf', 'sfef', 'sefsfef', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, 'dsada', 'dsada', 'dasdas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 1, 'sdasd', 'sdasd', 'sadsad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 'asdassadasd', 'asdassadasd', 'sadasasdas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 1, 'sdseded', 'SDSEDED', 'E', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 'qeq3eq', 'QEQ3EQ', 'EQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 1, 'wdwad', 'WDWAD', 'WDD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 1, 'wergvb5vcw', 'wergvb5vcw', 've gergergef', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 1, 'rgdgdgfgfffffffffffffffffssssss', 'rgdgdgfgfffffffffffffffffssssss', '&nbsp;grgrgergfwjcanjxi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 1, 'sacscsc', 'sacscsc', 'csdcsd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 1, 'scdcsdcd', 'scdcsdcd', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 1, 'hhoj9k', 'hhoj9k', 'XSCc', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
