-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: fenrir
-- Generation Time: Jun 09, 2020 at 05:44 AM
-- Server version: 5.1.73-1
-- PHP Version: 5.2.6-1+lenny16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eustache`
--

-- --------------------------------------------------------

--
-- Table structure for table `ExerciseImages`
--

CREATE TABLE IF NOT EXISTS `ExerciseImages` (
  `ID` int(11) NOT NULL,
  `IMG_NAME` varchar(500) NOT NULL,
  PRIMARY KEY (`ID`,`IMG_NAME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

