/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : restapi

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-08-01 17:39:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `artist`
-- ----------------------------
DROP TABLE IF EXISTS `artist`;
CREATE TABLE `artist` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of artist
-- ----------------------------

-- ----------------------------
-- Table structure for `continents`
-- ----------------------------
DROP TABLE IF EXISTS `continents`;
CREATE TABLE `continents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `continent` varchar(255) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `dateupdated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of continents
-- ----------------------------

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `continents_id` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of countries
-- ----------------------------

-- ----------------------------
-- Table structure for `genre`
-- ----------------------------
DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf32 NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of genre
-- ----------------------------

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ratio` double(2,2) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for `style`
-- ----------------------------
DROP TABLE IF EXISTS `style`;
CREATE TABLE `style` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `style` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of style
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles_id` int(11) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datelogin` datetime NOT NULL,
  `dateupdate` datetime NOT NULL,
  `datecreated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for `vote`
-- ----------------------------
DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `vote` double(4,2) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vote_users1_idx` (`users_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of vote
-- ----------------------------

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
