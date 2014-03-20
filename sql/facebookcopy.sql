-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2014 at 06:33 AM
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
  `to_user_id` int(11) DEFAULT NULL,
  `main_type` int(11) NOT NULL,
  `sub_type` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `from_user_id` (`from_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=207 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `from_user_id`, `to_user_id`, `main_type`, `sub_type`, `object_id`, `created_date`) VALUES
(202, 16, 20, 0, 0, -1, '2014-03-20 01:17:49'),
(203, 17, 20, 0, 0, -1, '2014-03-20 01:23:12'),
(204, 17, 16, 0, 0, -1, '2014-03-20 01:28:03'),
(205, 20, 16, 2, 1, -1, '2014-03-20 01:37:33'),
(206, 20, 17, 2, 1, -1, '2014-03-20 01:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(1024) NOT NULL,
  `content` varchar(5120) NOT NULL,
  `privacy_setting_id` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `circle`
--

INSERT INTO `circle` (`id`, `owner_user_id`, `name`) VALUES
(13, 17, 'mates'),
(14, 17, 'school'),
(15, 20, 'school'),
(17, 20, 'uni'),
(18, 16, ''),
(19, 21, 'test'),
(20, 20, 'test'),
(21, 20, 'school');

-- --------------------------------------------------------

--
-- Table structure for table `circle_conversation`
--

CREATE TABLE IF NOT EXISTS `circle_conversation` (
  `conversation_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `circle_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `circle_id` (`circle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` varchar(5120) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `creation_date`) VALUES
(8, '2014-03-20 06:30:59'),
(9, '2014-03-20 06:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `conversation_message`
--

CREATE TABLE IF NOT EXISTS `conversation_message` (
  `conversation_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  KEY `message_id` (`message_id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `conversation_id_2` (`conversation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation_message`
--

INSERT INTO `conversation_message` (`conversation_id`, `message_id`) VALUES
(8, 105),
(8, 106),
(8, 107),
(8, 108),
(9, 109);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `photo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_id` (`photo_id`),
  KEY `from_user_id` (`from_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `from_user_id`, `text`, `creation_date`, `photo_id`) VALUES
(105, 20, 'Hey!', '2014-03-20 06:30:59', NULL),
(106, 20, 'Any one there?', '2014-03-20 06:31:17', NULL),
(107, 20, 'cooooool, I have a convo!!!', '2014-03-20 06:31:36', NULL),
(108, 20, 'yo yo yo', '2014-03-20 06:32:05', NULL),
(109, 20, '123', '2014-03-20 06:32:29', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=169 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `activity_id`, `target_id`, `seen`) VALUES
(164, 202, 20, 1),
(165, 203, 20, 1),
(166, 204, 16, 0),
(167, 205, 16, 0),
(168, 206, 17, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_setting`
--

CREATE TABLE IF NOT EXISTS `privacy_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `circle_id` int(11) DEFAULT NULL,
  `name` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `main_type`, `name`, `surname`, `profile_photo_id`, `cover_photo_id`, `dob`, `email`, `password`) VALUES
(17, 0, 'jay', 'nanavati', NULL, NULL, '1992-12-23', 'jaysnanavati@hotmail.co.uk', '3831e9216d0a7b6d80ae1c1d8866dde36feca921'),
(18, 0, 'hay', 'nanavati', NULL, NULL, '1992-12-23', 'hay@hay.com', 'b5853d3b1ce6ee58e7cfb13ddfbcc4587a6dc1b6'),
(21, 0, 'jasper', 'nanavati', NULL, NULL, '1992-12-23', 'jasper@jasper.com', '3831e9216d0a7b6d80ae1c1d8866dde36feca921'),
(22, 0, 'kay', 'kay', NULL, NULL, '1992-12-23', 'kay@kay.com', 'cdbb4ce8f3bf361f7294328b0a28d08fd705af96');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`id`, `activity_id`, `to_entity_id`, `privacy_setting_id`, `since`) VALUES
(54, 202, 16, 1, '2014-03-20 01:37:33'),
(55, 203, 17, 1, '2014-03-20 01:38:01');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `profile_id`, `admin`, `verified`, `online`, `hash`) VALUES
(16, 17, 0, 0, 0, 'e77a763321d6cf825534ab228e1dfa33e71447c1'),
(17, 18, 0, 0, 0, '6d5db0e809f71a43d3bada01e4c1c4d4b501b435'),
(20, 21, 0, 0, 0, 'fc8d9e6e58db7ca861d6096d684bd0169ffd01cf'),
(21, 22, 0, 0, 0, 'db667d12a4034fedb3d483274955503ca4a361e2');

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
-- Dumping data for table `user_circle`
--

INSERT INTO `user_circle` (`user_id`, `circle_id`) VALUES
(16, 13),
(16, 14),
(16, 15),
(17, 15),
(16, 17),
(17, 18),
(20, 18),
(16, 19),
(16, 20),
(16, 21);

-- --------------------------------------------------------

--
-- Table structure for table `user_conversation`
--

CREATE TABLE IF NOT EXISTS `user_conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user_conversation`
--

INSERT INTO `user_conversation` (`id`, `conversation_id`, `user_id`) VALUES
(23, 8, 17),
(24, 8, 20),
(25, 9, 17),
(26, 9, 20);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `circle`
--
ALTER TABLE `circle`
  ADD CONSTRAINT `circle_ibfk_1` FOREIGN KEY (`owner_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `circle_conversation`
--
ALTER TABLE `circle_conversation`
  ADD CONSTRAINT `circle_conversation_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversation_message` (`conversation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `circle_conversation_ibfk_2` FOREIGN KEY (`circle_id`) REFERENCES `circle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conversation_message`
--
ALTER TABLE `conversation_message`
  ADD CONSTRAINT `conversation_message_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversation_message_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `user_conversation`
--
ALTER TABLE `user_conversation`
  ADD CONSTRAINT `user_conversation_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `conversation_message` (`conversation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_conversation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
