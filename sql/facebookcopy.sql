-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2014 at 06:59 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=241 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `from_user_id`, `to_user_id`, `main_type`, `sub_type`, `object_id`, `created_date`) VALUES
(202, 16, 20, 0, 0, -1, '2014-03-20 01:17:49'),
(203, 17, 20, 0, 0, -1, '2014-03-20 01:23:12'),
(204, 17, 16, 0, 0, -1, '2014-03-20 01:28:03'),
(205, 20, 16, 2, 1, -1, '2014-03-20 01:37:33'),
(206, 20, 17, 2, 1, -1, '2014-03-20 01:38:01'),
(207, 16, 17, 2, 1, -1, '2014-03-20 06:50:59'),
(208, 17, 21, 0, 0, -1, '2014-03-20 23:04:48'),
(209, 21, 17, 2, 1, -1, '2014-03-20 23:08:12'),
(210, 17, NULL, 3, 0, 1, '2014-03-21 02:43:27'),
(211, 17, NULL, 3, 1, -1, '2014-03-21 02:44:47'),
(212, 17, NULL, 3, 0, 2, '2014-03-21 03:14:02'),
(213, 17, NULL, 3, 0, 3, '2014-03-21 03:14:03'),
(214, 17, NULL, 3, 0, 4, '2014-03-21 03:14:04'),
(215, 17, NULL, 3, 0, 5, '2014-03-21 03:14:06'),
(216, 17, NULL, 3, 0, 6, '2014-03-21 03:14:06'),
(217, 17, NULL, 3, 0, 7, '2014-03-21 03:14:06'),
(218, 17, NULL, 3, 1, -1, '2014-03-21 03:14:21'),
(219, 17, NULL, 3, 1, -1, '2014-03-21 03:14:22'),
(220, 17, NULL, 3, 1, -1, '2014-03-21 03:14:22'),
(221, 17, NULL, 3, 1, -1, '2014-03-21 03:14:22'),
(222, 17, NULL, 3, 1, -1, '2014-03-21 03:14:22'),
(223, 17, NULL, 3, 1, -1, '2014-03-21 03:14:22'),
(224, 17, NULL, 3, 1, 9, '2014-03-21 16:44:16'),
(225, 17, NULL, 3, 1, 10, '2014-03-21 17:15:02'),
(226, 17, NULL, 3, 0, 0, '2014-03-21 17:17:16'),
(227, 17, NULL, 3, 0, 0, '2014-03-21 17:17:26'),
(228, 17, NULL, 3, 0, 0, '2014-03-21 17:18:34'),
(229, 17, NULL, 3, 0, 0, '2014-03-21 17:20:43'),
(230, 17, NULL, 3, 0, 0, '2014-03-21 17:20:46'),
(231, 17, NULL, 3, 0, 0, '2014-03-21 17:20:59'),
(232, 17, NULL, 3, 0, 0, '2014-03-21 17:21:23'),
(233, 17, NULL, 3, 0, 0, '2014-03-21 17:21:40'),
(234, 17, NULL, 3, 0, 0, '2014-03-21 17:22:29'),
(235, 17, NULL, 3, 0, 0, '2014-03-21 17:22:47'),
(236, 17, NULL, 3, 0, 23, '2014-03-21 17:27:16'),
(237, 17, NULL, 3, 1, 24, '2014-03-21 17:28:20'),
(238, 17, NULL, 3, 1, 25, '2014-03-21 17:44:01'),
(239, 17, NULL, 3, 1, 26, '2014-03-21 17:57:05'),
(240, 17, NULL, 3, 1, 27, '2014-03-21 17:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_user_id` (`owner_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `album_photo`
--

CREATE TABLE IF NOT EXISTS `album_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

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
(21, 20, 'school'),
(22, 16, 'friends');

-- --------------------------------------------------------

--
-- Table structure for table `circle_conversation`
--

CREATE TABLE IF NOT EXISTS `circle_conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `circle_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `circle_id` (`circle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `circle_conversation`
--

INSERT INTO `circle_conversation` (`id`, `conversation_id`, `circle_id`) VALUES
(30, 73, 14),
(31, 74, 14),
(32, 76, 13);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `post_id`, `content`, `date`, `deleted`) VALUES
(1, 17, 27, 'sdssdd', '2014-03-21 18:02:26', 0),
(2, 17, 27, 'sdsdsd', '2014-03-21 18:02:30', 0),
(3, 17, 27, 'sdssdd', '2014-03-21 18:02:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `creation_date`) VALUES
(72, '2014-03-21 02:11:00'),
(73, '2014-03-21 02:13:31'),
(74, '2014-03-21 02:15:18'),
(75, '2014-03-21 02:16:40'),
(76, '2014-03-21 02:17:27');

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
(72, 309),
(73, 310),
(72, 311),
(72, 312),
(74, 313),
(75, 314),
(76, 315);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=316 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `from_user_id`, `text`, `creation_date`, `photo_id`) VALUES
(309, 17, 'Hi', '2014-03-21 02:11:00', NULL),
(310, 17, '123', '2014-03-21 02:13:31', NULL),
(311, 17, 'sdsd', '2014-03-21 02:14:05', NULL),
(312, 17, 'sdsd', '2014-03-21 02:15:02', NULL),
(313, 17, '123', '2014-03-21 02:15:18', NULL),
(314, 17, '1212', '2014-03-21 02:16:40', NULL),
(315, 17, 'sdd', '2014-03-21 02:17:27', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=172 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `activity_id`, `target_id`, `seen`) VALUES
(164, 202, 20, 1),
(165, 203, 20, 1),
(166, 204, 16, 1),
(167, 205, 16, 1),
(168, 206, 17, 1),
(169, 207, 17, 1),
(170, 208, 21, 1),
(171, 209, 17, 1);

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

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `user_id`, `photo_url`, `privacy_setting_id`) VALUES
(1, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (5).jpg', 1),
(2, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (6).jpg', 1),
(3, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (8).jpg', 1),
(4, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (9).jpg', 1),
(5, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (10).jpg', 1),
(6, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/mickey_mouse-1097.jpg', 1),
(7, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (11).jpg', 1),
(8, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (12).jpg', 1),
(9, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (13).jpg', 1),
(10, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (14).jpg', 1),
(11, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (15).jpg', 1),
(12, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (16).jpg', 1),
(13, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (17).jpg', 1),
(14, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (18).jpg', 1),
(15, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (19).jpg', 1),
(16, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (20).jpg', 1),
(17, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (21).jpg', 1),
(18, 17, 'http://fbcopymedia.blob.core.windows.net/6d5db0e809f71a43d3bada01e4c1c4d4b501b435/burj-al-khalifa-dubai (22).jpg', 1);

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
  `photo_id` int(11) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `privacy_settings_id` (`privacy_setting_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `main_type`, `privacy_setting_id`, `date`, `location`, `content`, `photo_id`, `deleted`) VALUES
(27, 17, 1, 1, '2014-03-21 17:59:11', 'London, United Kingdom', 'dsdss', 18, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`id`, `activity_id`, `to_entity_id`, `privacy_setting_id`, `since`) VALUES
(54, 202, 16, 1, '2014-03-20 01:37:33'),
(55, 203, 17, 1, '2014-03-20 01:38:01'),
(56, 204, 17, 1, '2014-03-20 06:50:59'),
(57, 208, 17, 1, '2014-03-20 23:08:12');

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
(20, 13),
(16, 14),
(20, 14),
(16, 15),
(17, 15),
(16, 17),
(17, 18),
(20, 18),
(16, 19),
(17, 19),
(16, 20),
(16, 21),
(17, 22);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=149 ;

--
-- Dumping data for table `user_conversation`
--

INSERT INTO `user_conversation` (`id`, `conversation_id`, `user_id`) VALUES
(142, 72, 16),
(143, 72, 17),
(144, 73, 17),
(145, 74, 17),
(146, 75, 20),
(147, 75, 17),
(148, 76, 17);

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
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`owner_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `album_photo`
--
ALTER TABLE `album_photo`
  ADD CONSTRAINT `album_photo_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `album_photo_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`privacy_setting_id`) REFERENCES `privacy_setting` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `user_conversation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_conversation_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `conversation_message` (`conversation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
