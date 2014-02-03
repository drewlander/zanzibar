-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2014 at 09:34 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Zanzibar`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupDescription`
--

CREATE TABLE IF NOT EXISTS `groupDescription` (
  `groupID` varchar(25) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `creation_reason` varchar(50) NOT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Groups`
--

CREATE TABLE IF NOT EXISTS `Groups` (
  `groupID` varchar(25) NOT NULL,
  `ownerID` varchar(25) NOT NULL DEFAULT '0',
  `isJoinable` tinyint(1) NOT NULL,
  PRIMARY KEY (`groupID`,`ownerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Groups`
--

INSERT INTO `Groups` (`groupID`, `ownerID`, `isJoinable`) VALUES
('assassins2', '619800000', 0),
('salem-users', '619800000', 0),
('salem-users', '619800027', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Group_Members`
--

CREATE TABLE IF NOT EXISTS `Group_Members` (
  `groupID` varchar(25) NOT NULL,
  `userID` varchar(25) NOT NULL,
  PRIMARY KEY (`groupID`,`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `userID` varchar(25) NOT NULL,
  `sessionID` text NOT NULL,
  `last_login` text NOT NULL,
  `ipaddy` text NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` varchar(25) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `f_name`, `l_name`, `email`) VALUES
('0', 'Directory', 'Administrator', 'admin@sudoscript.net'),
('999', 'Sam', 'Scott', 'sscott@rackspace.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

