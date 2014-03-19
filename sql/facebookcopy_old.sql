-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2014 at 11:36 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.5.1

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
  `to_user_id` int(11) DEFAULT NULL,
  `main_type` int(11) NOT NULL,
  `sub_type` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `from_user_id` (`from_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `from_user_id`, `to_user_id`, `main_type`, `sub_type`, `object_id`, `created_date`) VALUES
(115, 9, NULL, 3, 0, 24, '2014-03-18 22:32:14'),
(116, 9, NULL, 3, 0, 25, '2014-03-18 22:32:22'),
(117, 9, NULL, 3, 0, 26, '2014-03-18 22:32:33'),
(122, 8, 9, 0, 0, -1, '2014-03-18 23:09:29'),
(123, 9, 8, 2, 1, -1, '2014-03-18 23:10:44'),
(124, 14, 8, 0, 0, -1, '2014-03-18 23:16:05'),
(125, 8, 14, 2, 1, -1, '2014-03-18 23:16:24'),
(126, 14, NULL, 3, 0, 27, '2014-03-18 23:26:01');

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
  KEY `circle_ibfk_1` (`owner_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `target` (`target_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `activity_id`, `target_id`, `seen`) VALUES
(99, 122, 9, 1),
(100, 123, 8, 1),
(101, 124, 8, 1),
(102, 125, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `privacy_setting_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `privacy_settings_id` (`privacy_setting_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `main_type` int(11) NOT NULL,
  `privacy_setting_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(512) NOT NULL,
  `content` varchar(5120) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `privacy_settings_id` (`privacy_setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `main_type`, `privacy_setting_id`, `date`, `location`, `content`, `deleted`) VALUES
(24, 9, 0, 1, '2014-03-18 22:32:14', 'London, United Kingdom', 'Public post', 0),
(25, 9, 0, 2, '2014-03-18 22:32:22', 'London, United Kingdom', 'Only friends should see this', 0),
(26, 9, 0, 3, '2014-03-18 22:32:33', 'London, United Kingdom', 'Only friends of friends should see this', 0),
(27, 14, 0, 3, '2014-03-18 23:26:01', 'London, United Kingdom', 'FRIEEENDS OF FRIEEENDS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `privacy_setting`
--

CREATE TABLE IF NOT EXISTS `privacy_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `circle_id` int(11) DEFAULT NULL,
  `name` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `privacy_setting`
--

INSERT INTO `privacy_setting` (`id`, `circle_id`, `name`) VALUES
(1, -1, 'Public'),
(2, -1, 'Friends'),
(3, -1, 'Friends of friends');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_type` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `surname` varchar(512) NOT NULL,
  `profile_photo_id` int(11) DEFAULT NULL,
  `cover_photo_id` int(11) DEFAULT NULL,
  `dob` date NOT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_photo_id` (`profile_photo_id`),
  KEY `cover_photo_id` (`cover_photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `main_type`, `name`, `surname`, `profile_photo_id`, `cover_photo_id`, `dob`, `email`, `password`) VALUES
(2, 0, 'Jay', 'Nanavati', NULL, NULL, '0000-00-00', 'jaysnanavati@hotmail.co.uk', '3831e9216d0a7b6d80ae1c1d8866dde36feca921'),
(3, 0, 'Hay', 'Nanavati', NULL, NULL, '0000-00-00', 'hay@hay.com', 'b5853d3b1ce6ee58e7cfb13ddfbcc4587a6dc1b6'),
(4, 0, 'Nik', 'Vorkinn', NULL, NULL, '2001-01-02', 'n.vorkinn@gmail.com', 'd99b6f33ea54c8d27bb39cc6d126299afcb4a9c7'),
(5, 99, 'Victor Cristian', 'Popescu', NULL, NULL, '2014-12-31', 'victorcrpopescu@gmail.com', '9c1e7f7dc55369ed020a964666b66553722ac7b2'),
(6, 99, 'Test1', 'Account', NULL, NULL, '2014-12-31', 'test@test.com', 'b626f58c301e022f34967a25611a34c775226834'),
(9, 0, 'A', 'A', NULL, NULL, '2014-12-31', 'test1@commy.com', 'b444ac06613fc8d63795be9ad0beaf55011936ac'),
(10, 0, 'B', 'B', NULL, NULL, '2014-12-31', 'test2@commy.com', '109f4b3c50d7b0df729d299bc6f8e9ef9066971f'),
(15, 0, 'C', 'C', NULL, NULL, '2014-12-31', 'test3@commy.com', '3ebfa301dc59196f18593c45e519287a23297589');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `to_entity_id` int(11) NOT NULL,
  `privacy_setting_id` int(11) NOT NULL,
  `since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `privacy_settings_id` (`privacy_setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`id`, `activity_id`, `to_entity_id`, `privacy_setting_id`, `since`) VALUES
(25, 122, 8, 1, '2014-03-18 23:10:44'),
(26, 124, 14, 1, '2014-03-18 23:16:24');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `profile_id`, `admin`, `verified`, `online`, `hash`) VALUES
(1, 2, 0, 1, 1, '8bfd13cad0bc4b2ac41d9e235951e72c9b62c2aa'),
(2, 3, 0, 1, 1, 'ebddd6b268d91849108444d7fc5c9941138e8ee0'),
(3, 4, 0, 1, 1, 'hallo'),
(4, 5, 99, 1, 99, '192fc044e74dffea144f9ac5dc9f3395'),
(5, 6, 99, 1, 99, '2421fcb1263b9530df88f7f002e78ea5'),
(8, 9, 0, 1, 0, '9dbb7f83a82dff4d62f7f5f2c0491527ce35cce8'),
(9, 10, 0, 1, 0, '09d66f6e5482d9b0ba91815c350fd9af3770819b'),
(14, 15, 0, 1, 0, 'ec91fc2dc062c0f220b5d7b52ac6446011bf98cd');

-- --------------------------------------------------------

--
-- Table structure for table `user_circle`
--

CREATE TABLE IF NOT EXISTS `user_circle` (
  `user_id` int(11) NOT NULL,
  `circle_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`circle_id`),
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
-- Constraints for table `circle`
--
ALTER TABLE `circle`
  ADD CONSTRAINT `circle_ibfk_1` FOREIGN KEY (`owner_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`privacy_setting_id`) REFERENCES `privacy_setting` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_2` FOREIGN KEY (`profile_photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_3` FOREIGN KEY (`cover_photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
