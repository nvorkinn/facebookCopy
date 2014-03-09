-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2014 at 05:27 AM
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
CREATE DATABASE IF NOT EXISTS `facebookcopy` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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
  `sub_type` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `from_user_id` (`from_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `from_user_id`, `to_user_id`, `type`, `sub_type`, `object_id`, `created_date`) VALUES
(93, 2, 2, 0, 0, -1, '2014-02-14 19:24:23'),
(94, 2, 2, 2, 1, -1, '2014-02-14 19:24:26');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `circle`
--

INSERT INTO `circle` (`id`, `owner_user_id`, `name`) VALUES
(1, 2, 'Friends'),
(2, 2, 'Enemies');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `activity_id`, `target_id`, `seen`) VALUES
(89, 93, 2, 1),
(90, 94, 2, 1);

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
(4, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (69).JPG', 1),
(5, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (70).JPG', 1),
(6, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (71).JPG', 1),
(7, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (72).JPG', 1),
(8, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (74).JPG', 1),
(9, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (75).JPG', 1),
(10, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (76).JPG', 1),
(11, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (77).JPG', 1),
(12, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (78).JPG', 1),
(13, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (79).JPG', 1),
(14, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (80).JPG', 1),
(15, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20131215_173154 (7).JPG', 1),
(16, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (81).JPG', 1),
(17, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/WIN_20140107_143834 (82).JPG', 1),
(18, 7, 'http://fbcopymedia.blob.core.windows.net/49e3d046636e06b2d82ee046db8e6eb9a2e11e16/Ggb_by_night.jpg', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `type`, `privacy_settings_id`, `date`, `location`, `content`, `deleted`) VALUES
(2, 1, 0, 1, '2014-02-14 22:18:32', 'London, United Kingdom', 'dsdas', 0),
(3, 1, 0, 1, '2014-02-14 22:21:21', 'London, United Kingdom', 'dasdasfdsf', 0),
(4, 1, 0, 1, '2014-02-14 22:24:41', 'London, United Kingdom', 'fsdfsda', 0),
(5, 1, 0, 1, '2014-02-14 22:24:43', 'London, United Kingdom', 'ffasdfds', 0),
(6, 1, 0, 1, '2014-02-14 22:24:51', 'London, United Kingdom', 'fdfasdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `privacy_setting`
--

CREATE TABLE IF NOT EXISTS `privacy_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visible_to` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `privacy_setting`
--

INSERT INTO `privacy_setting` (`id`, `visible_to`, `name`) VALUES
(1, 0, 'Public'),
(2, 99, 'somename'),
(3, 99, 'somename'),
(4, 99, 'somename');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `privacy_setting_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `surname` varchar(512) NOT NULL,
  `profile_photo_id` int(11) DEFAULT NULL,
  `cover_photo_id` int(11) DEFAULT NULL,
  `dob` date NOT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `privacy_settings_id` (`privacy_setting_id`),
  KEY `profile_photo_id` (`profile_photo_id`),
  KEY `cover_photo_id` (`cover_photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `type`, `privacy_setting_id`, `name`, `surname`, `profile_photo_id`, `cover_photo_id`, `dob`, `email`, `password`) VALUES
(2, 0, 1, 'Jay', 'Nanavati', NULL, NULL, '0000-00-00', 'jaysnanavati@hotmail.co.uk', '3831e9216d0a7b6d80ae1c1d8866dde36feca921'),
(3, 0, 1, 'Hay', 'Nanavati', NULL, NULL, '0000-00-00', 'hay@hay.com', 'b5853d3b1ce6ee58e7cfb13ddfbcc4587a6dc1b6'),
(4, 0, 1, 'Nik', 'Vorkinn', NULL, NULL, '2001-01-02', 'n.vorkinn@gmail.com', 'd99b6f33ea54c8d27bb39cc6d126299afcb4a9c7'),
(5, 99, 3, 'Victor Cristian', 'Popescu', NULL, NULL, '2014-12-31', 'victorcrpopescu@gmail.com', '9c1e7f7dc55369ed020a964666b66553722ac7b2'),
(6, 99, 4, 'Test1', 'Account', NULL, NULL, '2014-12-31', 'test@test.com', 'b626f58c301e022f34967a25611a34c775226834'),
(7, 0, 1, 'kay', 'nanavati', NULL, NULL, '0000-00-00', 'kay@kay.com', '3831e9216d0a7b6d80ae1c1d8866dde36feca921'),
(8, 0, 1, 'jasper', 'jasper', NULL, 18, '0000-00-00', 'jasper@jasper.com', '3831e9216d0a7b6d80ae1c1d8866dde36feca921');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`id`, `activity_id`, `to_entity_id`, `privacy_setting_id`, `since`) VALUES
(21, 93, 2, 1, '2014-02-14 19:24:26');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `profile_id`, `admin`, `verified`, `online`, `hash`) VALUES
(1, 2, 0, 1, 1, '8bfd13cad0bc4b2ac41d9e235951e72c9b62c2aa'),
(2, 3, 0, 1, 1, 'ebddd6b268d91849108444d7fc5c9941138e8ee0'),
(3, 4, 0, 1, 1, 'hallo'),
(4, 5, 99, 1, 99, '192fc044e74dffea144f9ac5dc9f3395'),
(5, 6, 99, 1, 99, '2421fcb1263b9530df88f7f002e78ea5'),
(6, 7, 0, 0, 0, 'cb7a1d775e800fd1ee4049f7dca9e041eb9ba083'),
(7, 8, 0, 0, 0, '49e3d046636e06b2d82ee046db8e6eb9a2e11e16');

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
(2, 2);

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
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`privacy_settings_id`) REFERENCES `privacy_setting` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_3` FOREIGN KEY (`cover_photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`privacy_setting_id`) REFERENCES `privacy_setting` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_2` FOREIGN KEY (`profile_photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
