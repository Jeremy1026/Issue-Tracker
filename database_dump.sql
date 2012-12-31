-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2012 at 03:43 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `main`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issueid` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `createdby` int(11) NOT NULL,
  `creationdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `issueid`, `comment`, `createdby`, `creationdate`) VALUES
(1, 2, 'I''ll work on it ASAP.', 3, '2012-12-29 19:58:10'),
(2, 2, 'Still looking into it.', 3, '2012-12-29 19:58:54'),
(3, 2, 'Unable to reproduce.', 3, '2012-12-29 19:59:11'),
(4, 2, 'All is well as far as I can tell.', 3, '2012-12-29 22:11:21'),
(5, 2, 'Adding a comment, nothing to see here.', 3, '2012-12-29 22:13:23'),
(6, 2, 'Adding morning comment.', 3, '2012-12-30 08:58:08'),
(7, 2, 'Testing?', 3, '2012-12-30 14:27:55'),
(8, 1, 'Well duh! I just started working on it last week!', 3, '2012-12-30 19:32:52'),
(9, 2, 'Checking update time.', 3, '2012-12-30 19:39:29'),
(10, 1, 'Checking last update fixes.', 3, '2012-12-30 19:46:03'),
(11, 1, 'Checking last update fixes.\r\n', 3, '2012-12-30 20:19:04'),
(12, 2, 'Testing adding users.', 3, '2012-12-30 21:03:53'),
(13, 2, 'Testing again.', 3, '2012-12-30 21:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `createdby` int(11) NOT NULL,
  `creationdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `application` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `title`, `description`, `createdby`, `creationdate`, `updatedate`, `status`, `application`) VALUES
(1, 'Bug in Issue Tracker', 'Nothing really works yet.', 1, '2012-12-26 21:32:00', '2012-12-29 21:32:00', b'1', 'Issue Tracker'),
(2, 'Creating Issue Error', 'Creating issues causes crash.', 3, '2012-12-29 14:24:29', '2012-12-30 21:04:06', b'1', 'Issue Tracker'),
(3, 'No emails are being sent', 'When I create new issues, no one is getting e', 3, '2012-12-30 21:34:46', '2012-12-30 21:34:46', b'1', ''),
(4, 'Application doesn''t appear on new tickets', 'When creating a new issue, the application do', 3, '2012-12-30 21:37:49', '2012-12-30 21:37:49', b'1', 'Issue Tracker'),
(5, 'Users Aren''t Added', 'When creating a new ticket, selected users aren''t added.', 3, '2012-12-30 21:39:41', '2012-12-30 21:39:41', b'1', 'Issue Tracker');

-- --------------------------------------------------------

--
-- Table structure for table `issueTags`
--

CREATE TABLE IF NOT EXISTS `issueTags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issueID` int(11) NOT NULL,
  `tag` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `issueTags`
--

INSERT INTO `issueTags` (`id`, `issueID`, `tag`) VALUES
(1, 1, 'General'),
(2, 1, 'PHP'),
(3, 1, 'Error'),
(4, 2, 'PHP'),
(5, 3, 'bug'),
(6, 3, 'php'),
(7, 3, 'issue'),
(8, 4, 'php'),
(9, 4, 'bug'),
(10, 4, 'mysql'),
(11, 5, 'php'),
(12, 5, 'mysql');

-- --------------------------------------------------------

--
-- Table structure for table `issueUsers`
--

CREATE TABLE IF NOT EXISTS `issueUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issueID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `issueUsers`
--

INSERT INTO `issueUsers` (`id`, `issueID`, `userID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 6),
(4, 2, 1),
(6, 2, 6),
(7, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Jillian', 'Curcio', 'Jeremy1026@gmail.com', ''),
(3, 'Jeremy', 'Curcio', 'j.curcio@me.com', 'fCryptography::password_hash#p2axvTcP0F#591ed77ec393c43341cc1c9376524020ccafd1c7'),
(4, 'Test', 'User', 'test@test.com', 'fCryptography::password_hash#xpJvoYx1im#cecbf43a4aeb7da9bd26fe85fc9668e4d6354961'),
(6, 'No', 'One', 'noone@fake.com', 'fCryptography::password_hash#sAGTqddeG7#5f9295aac6f11cb3b91f38ce29981ceaf86c0169');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
