-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2014 at 08:13 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `facebookcopy`
--
CREATE DATABASE IF NOT EXISTS `facebookcopy` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `facebookcopy`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `from_user_id` (`from_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `from_user_id`, `to_user_id`, `type`, `created_date`) VALUES
(14, 1, 2, 0, '2014-02-02 23:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `circle`
--

CREATE TABLE IF NOT EXISTS `circle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_user_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_user_id` (`owner_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `content` varchar(5120) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `content` varchar(5120) NOT NULL,
  `status` int(11) NOT NULL,
  `privacy_setting_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `activity_id_2` (`activity_id`),
  KEY `privacy_settings_id` (`privacy_setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `target` (`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `activity_id`, `target_id`, `seen`, `created_date`) VALUES
(0, 14, 2, 0, '2014-02-02 23:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10240) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location` varchar(512) NOT NULL,
  `privacy_setting_id` int(11) NOT NULL,
  `deleted` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `privacy_settings_id` (`privacy_setting_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `privacy_settings_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(512) NOT NULL,
  `content` varchar(5120) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `privacy_settings_id` (`privacy_settings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_setting`
--

CREATE TABLE IF NOT EXISTS `privacy_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visible_to` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `privacy_setting`
--

INSERT INTO `privacy_setting` (`id`, `visible_to`, `name`) VALUES
(1, 0, 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `privacy_setting_id` int(11) NOT NULL,
  `photo_code` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `surname` varchar(512) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `privacy_settings_id` (`privacy_setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `type`, `privacy_setting_id`, `photo_code`, `name`, `surname`, `dob`, `email`, `password`) VALUES
(2, 0, 1, -1, 'Jay', 'Nanavati', '0000-00-00', 'jaysnanavati@hotmail.co.uk', '3831e9216d0a7b6d80ae1c1d8866dde36feca921'),
(3, 0, 1, -1, 'Hay', 'Nanavati', '0000-00-00', 'hay@hay.com', 'f995f026497542434f82879af2ed3c2b7bd44877'),
(1, 0, 1, -1, 'Nikolai', 'Vorkinn', '1991-07-06', 'n.vorkinn@gmail.com', '2ed99f3bbeda017280bb9cbcfb8de4ee2886eb6b');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
  `activity_id` int(11) NOT NULL,
  `to_entity_id` int(11) NOT NULL,
  `privacy_setting_id` int(11) NOT NULL,
  `since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `activity_id` (`activity_id`),
  KEY `privacy_settings_id` (`privacy_setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `hash` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`),
  KEY `profile_id_2` (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `profile_id`, `admin`, `verified`, `online`, `hash`) VALUES
(1, 2, 0, 1, 1, '-1'),
(2, 3, 0, 1, 1, '-1');

-- --------------------------------------------------------

--
-- Table structure for table `user_circle`
--

CREATE TABLE IF NOT EXISTS `user_circle` (
  `user_id` int(11) NOT NULL,
  `circle_id` int(11) NOT NULL,
  KEY `circle_id` (`circle_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `circle`
--
ALTER TABLE `circle`
  ADD CONSTRAINT `circle_ibfk_1` FOREIGN KEY (`owner_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`privacy_setting_id`) REFERENCES `privacy_setting` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `photo_ibfk_2` FOREIGN KEY (`privacy_setting_id`) REFERENCES `privacy_setting` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`privacy_settings_id`) REFERENCES `privacy_setting` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`privacy_setting_id`) REFERENCES `privacy_setting` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `relationship`
--
ALTER TABLE `relationship`
  ADD CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`privacy_setting_id`) REFERENCES `privacy_setting` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_circle`
--
ALTER TABLE `user_circle`
  ADD CONSTRAINT `user_circle_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_circle_ibfk_2` FOREIGN KEY (`circle_id`) REFERENCES `circle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
