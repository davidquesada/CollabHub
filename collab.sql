-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 08, 2013 at 10:11 AM
-- Server version: 5.6.12
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `collab`
--
CREATE DATABASE IF NOT EXISTS `collab` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE `collab`;

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `talent_id` int(10) NOT NULL,
  `sourceType` enum('default','youtube','github','soundcloud') COLLATE latin1_bin NOT NULL DEFAULT 'default',
  `sourceIdentifier` varchar(100) COLLATE latin1_bin NOT NULL,
  `title` varchar(250) COLLATE latin1_bin NOT NULL,
  `description` varchar(200) COLLATE latin1_bin NOT NULL,
  `content` mediumtext COLLATE latin1_bin NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`talent_id`),
  KEY `date` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `user_id`, `talent_id`, `sourceType`, `sourceIdentifier`, `title`, `description`, `content`, `date`) VALUES
(1, 1, 2, 'default', '', 'Something Special.', 'A really fascinating tale.', 'It''s not really that fascinating. I LIED.', '2007-05-17'),
(2, 1, 1, 'default', '', 'Welcome Home', 'A song by Coheed & Cambria.', '', '0000-00-00'),
(3, 1, 1, 'default', '', 'Paranoid', 'Black Sabbath', '', '2013-09-08'),
(4, 1, 1, 'default', '', 'Highway Star', 'A song by Deep Purple. Has cool guitar solo and is difficult to play on Rock Band.', '', '2013-09-08'),
(5, 1, 2, 'youtube', 'VOsJnasYCNE', 'Dark Warrior', 'By Andrew Rayel', '', '2013-09-08'),
(6, 1, 2, 'youtube', '2Fz3zFqLc3E', 'Nice Guys', 'I''m testing the youtube api thing with more videos.', '', '2013-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `talents`
--

CREATE TABLE IF NOT EXISTS `talents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `title` varchar(120) COLLATE latin1_bin NOT NULL,
  `description` mediumtext COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=14 ;

--
-- Dumping data for table `talents`
--

INSERT INTO `talents` (`id`, `user_id`, `title`, `description`) VALUES
(1, 1, 'Guitar', ''),
(2, 1, 'Thermonuclear Astrophysics', ''),
(4, 1, 'Deception', ''),
(5, 1, 'Basketball.', 'YO, NAND!'),
(6, 8, 'The First Talent', ''),
(7, 8, 'The Second Talent', ''),
(8, 8, 'The Third Talent', ''),
(9, 4, 'Firemaking', 'I can make fires, yo.'),
(10, 11, 'Reddit', 'Upvotes, downvotes, comments... aww yiss'),
(11, 9, 'Beatboxing', 'I put boots on cats'),
(12, 9, 'Sex', ''),
(13, 9, 'baka', 'BAKAYARO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `FBID` varchar(255) COLLATE latin1_bin DEFAULT NULL COMMENT 'FB-user id',
  `email` varchar(120) COLLATE latin1_bin NOT NULL,
  `password` varchar(120) COLLATE latin1_bin NOT NULL,
  `first_name` varchar(100) COLLATE latin1_bin NOT NULL,
  `last_name` varchar(100) COLLATE latin1_bin NOT NULL,
  `bio` mediumtext COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_2` (`email`),
  UNIQUE KEY `FB-ID` (`FBID`),
  KEY `email` (`email`,`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FBID`, `email`, `password`, `first_name`, `last_name`, `bio`) VALUES
(1, NULL, 'davidq2012@gmail.com', 'qwer', 'David', 'Quesada', 'I put in this default bio. You might want to change this.'),
(4, NULL, 'nand', 'dalal', 'Nandalal', 'Nandeska', 'I put in this default bio. You might want to change this.'),
(9, NULL, 'vikas942@gmail.com', 'DavidQuesadaishot', 'Vikas', 'Kumar', 'I put in this default bio. You might want to change this.'),
(10, NULL, 'rohitboss1994@gmail.com', 'steamed-paella', 'Rohit', 'Ramprasad', 'I put in this default bio. You might want to change this.'),
(11, NULL, 'noodle@umich.edu', 'herpderp', 'Charles', 'Lewis', 'I put in this default bio. You might want to change this.'),
(12, NULL, 'dquesada@umich.edu', 'yo', 'Bender', 'Rodriguez', 'I put in this default bio. You might want to change this.'),
(13, NULL, 'shudas@umich.edu', 'baka', 'Shuvajit', 'Das', ''),
(15, '100003867665119', '', 'NULL', 'Rohit', 'Ramprasad', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_tags`
--

CREATE TABLE IF NOT EXISTS `user_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `title` varchar(40) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `title` (`title`(1))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_tags`
--

INSERT INTO `user_tags` (`id`, `user_id`, `title`) VALUES
(1, 1, 'guitar'),
(2, 1, 'hacker');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
