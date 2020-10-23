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
-- Structura de tabel pentru tabelul `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `style_id` int(11) DEFAULT NULL,
  `substyle_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `bio` text,
  `vote` double(10,0) DEFAULT NULL,
  `artworks` int(11) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Salvarea datelor din tabel `artist`
--

INSERT INTO `artist` (`id`, `fullname`, `genre_id`, `style_id`, `substyle_id`, `country_id`, `date_of_birth`, `bio`, `vote`, `artworks`, `avatar`, `users_id`) VALUES
(48, 'test', 2, 3, 3, 6, '2015-08-10', 'gsdfs', 3, 42, 'c5f168c83eaafbbe82dc45a1f20c74fe.jpg', 18),
(52, 'gsdfs', 1, 1, 1, 5, '2015-08-03', 'fsdfs', 5, 32, '5044994505b8699099155f7603766a5c.png', 21),
(54, 'gwerw', 1, 1, 1, 5, '2015-08-03', 'twerw', 4, 43, 'ea56b26833e584fa0ee833bc13da6e3c.jpg', 15),
(55, 'gsda', 1, 1, 1, 5, '2015-08-04', 'gdsfs', 5, 23, '7937c54231aaf264ffccdd155cbce2c5.jpg', 15),
(56, 'Liviu', 2, 3, 3, 6, '2015-08-11', '<b>fa<i>ds</i>a<u>sd</u></b><i></i>', 6, 23, '03334c7132f074e2d622d2e108fb113b.jpg', 15),
(57, 'fasdas', 1, 1, 3, 5, '2015-08-03', 'dasdasfasd', 6, 23, 'b0393f3223036c76426f1bd2a4455847.png', 15),
(58, 'fullname', 1, 1, 1, 5, '2015-08-05', 'dasdas', 6, 32, '0dd5cba4df74456989c9333b412da394.jpg', 21),
(59, 'Artist', 1, 1, 1, 5, '2015-08-03', 'dasda', 7, 23, '4c2650b471b1b6ed7242156c917b934c.png', 18);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
