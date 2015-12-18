-- phpMyAdmin SQL Dump
-- version 4.2.0-alpha2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2015 at 05:14 PM
-- Server version: 5.5.36-MariaDB
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `meeting`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
`agendaID` bigint(200) NOT NULL,
  `meetingID` bigint(200) NOT NULL DEFAULT '0',
  `agendaTitle` varchar(250) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`agendaID`, `meetingID`, `agendaTitle`) VALUES
(115, 13, 'topic 1'),
(116, 13, 'topic 2'),
(117, 13, 'topic 3'),
(118, 15, 'swing'),
(119, 15, 'bob'),
(120, 16, 'this is '),
(121, 16, 'drp'),
(122, 16, 'big'),
(123, 17, 'random'),
(124, 17, 'stuff2'),
(125, 18, 'agenda 1'),
(126, 18, 'agenda 2'),
(127, 18, ' agenda 3'),
(128, 18, 'agenda 4');

-- --------------------------------------------------------

--
-- Table structure for table `associate`
--

CREATE TABLE IF NOT EXISTS `associate` (
`assID` bigint(200) NOT NULL,
  `userID` bigint(250) DEFAULT NULL,
  `associateEmail` varchar(250) DEFAULT NULL,
  `associateTitle` varchar(250) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `associate`
--

INSERT INTO `associate` (`assID`, `userID`, `associateEmail`, `associateTitle`) VALUES
(45, 5, 'asf@sdvi', 'mark'),
(46, 5, 'asf@sdvi', 'bob'),
(47, 5, 'asf@sdvi', 'stark'),
(48, 5, 'asf@sdvi', 'rob'),
(49, 5, 'asf@sdvi', 'junior'),
(50, 5, 'dkom23@hotmail.com', 'dima');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
`userID` bigint(200) NOT NULL,
  `user` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='This is the user table' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userID`, `user`, `password`) VALUES
(5, 'bob', '$2y$10$0r6KcVzeHf.g/j.tsDXYnOM2/wxICfOtdZRZBvKcMxwdL8U01R56i');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE IF NOT EXISTS `meeting` (
`meetingID` bigint(200) NOT NULL,
  `meetingRef` varchar(250) DEFAULT NULL,
  `userID` bigint(200) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `meetingStart` datetime DEFAULT NULL,
  `meetingEnd` datetime DEFAULT NULL,
  `meetingPosition` bigint(200) DEFAULT NULL,
  `breakOut` bigint(200) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='This is the meeting table' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`meetingID`, `meetingRef`, `userID`, `password`, `meetingStart`, `meetingEnd`, `meetingPosition`, `breakOut`) VALUES
(12, '11', 5, '12345', '2015-05-15 00:00:00', '2015-05-15 13:00:00', NULL, NULL),
(13, '5', 5, '12345', '2015-05-14 00:00:00', '2015-05-14 00:00:00', 6, 0),
(14, '31', 5, '12345', '2015-05-14 00:00:00', '2015-05-14 00:00:00', NULL, NULL),
(15, 'how to', 5, '12345', '2015-05-14 00:00:00', '2015-05-14 00:00:00', NULL, NULL),
(16, 'bobbbbbbb', 5, '12345', '2015-05-15 00:00:00', '2015-05-15 00:00:00', 3, 0),
(17, 'presentation', 5, '12345', '2015-05-15 00:00:00', '2015-05-15 00:00:00', 5, 0),
(18, 'final', 5, '12345', '2015-05-15 11:00:00', '2015-05-15 12:00:00', 4, 1),
(19, 'home', 5, '12345', '2015-05-15 00:00:00', '2015-05-15 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
`topicID` bigint(200) NOT NULL,
  `agendaID` bigint(200) DEFAULT NULL,
  `meetingID` bigint(200) DEFAULT NULL,
  `topicName` varchar(250) DEFAULT NULL,
  `brokeOut` varchar(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topicID`, `agendaID`, `meetingID`, `topicName`, `brokeOut`) VALUES
(96, 123, 17, 'stuff', 'yes'),
(97, 123, 17, 'blah', NULL),
(98, 123, 17, 'brbrbrbr', 'yes'),
(99, 124, 17, 'three', 'yes'),
(100, 124, 17, 'two', NULL),
(101, 125, 18, 'topic 1', NULL),
(102, 125, 18, 'topic2', NULL),
(103, 125, 18, 'topic 3', 'yes'),
(104, 126, 18, 'topic 3', 'yes'),
(105, 127, 18, 'there are no topics for this agenda', 'yes'),
(106, 128, 18, '', NULL),
(107, 128, 18, '', NULL),
(108, 128, 18, '', NULL),
(109, 128, 18, '', NULL),
(110, 128, 18, '', NULL),
(111, 128, 18, '', NULL),
(112, 128, 18, '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
 ADD PRIMARY KEY (`agendaID`,`meetingID`);

--
-- Indexes for table `associate`
--
ALTER TABLE `associate`
 ADD PRIMARY KEY (`assID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
 ADD PRIMARY KEY (`meetingID`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
 ADD PRIMARY KEY (`topicID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
MODIFY `agendaID` bigint(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `associate`
--
ALTER TABLE `associate`
MODIFY `assID` bigint(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
MODIFY `userID` bigint(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
MODIFY `meetingID` bigint(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
MODIFY `topicID` bigint(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
