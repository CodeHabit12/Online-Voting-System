-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2014 at 07:40 AM
-- Server version: 5.5.28
-- PHP Version: 5.3.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sql_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `student5`
--

CREATE TABLE IF NOT EXISTS `student5` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `class` varchar(10) NOT NULL DEFAULT '',
  `mark` int(3) NOT NULL DEFAULT '0',
  `sex` varchar(6) NOT NULL DEFAULT 'male',
  `city` varchar(35) NOT NULL DEFAULT '',
  `country` varchar(3) NOT NULL DEFAULT '',
  `state` varchar(20) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `student5`
--

INSERT INTO `student5` (`id`, `name`, `class`, `mark`, `sex`, `city`, `country`, `state`) VALUES
(1, 'John Deo', 'Four', 75, 'female', 'London', 'GBR', 'England'),
(2, 'Max Ruin', 'Three', 85, 'male', 'Hyderabad', 'IND', 'Andhra Pradesh'),
(3, 'Arnold', 'Three', 55, 'male', 'North York', 'CAN', 'Ontario'),
(4, 'Krish Star', 'Four', 60, 'female', 'Sheffield', 'GBR', 'England'),
(5, 'John Mike', 'Four', 60, 'female', 'Vishakhapatnam', 'IND', 'Andhra Pradesh'),
(6, 'Alex John', 'Four', 55, 'male', 'Mississauga', 'CAN', 'Ontario'),
(7, 'My John Rob', 'Fifth', 78, 'male', 'Los Angeles', 'USA', 'California'),
(8, 'Asruid', 'Five', 85, 'male', 'Birmingham', 'GBR', 'England'),
(9, 'Tes Qry', 'Six', 78, 'male', 'Madurai', 'IND', 'Tamil Nadu'),
(10, 'Big John', 'Four', 55, 'female', 'Vancouver', 'CAN', 'British Colombia'),
(11, 'Ronald', 'Six', 89, 'female', 'San Diego', 'USA', 'California'),
(12, 'Recky', 'Six', 94, 'female', 'Ajmer', 'IND', 'Rajasthan'),
(13, 'Kty', 'Seven', 88, 'female', 'Surendranagar', 'IND', 'Gujarat'),
(14, 'Bigy', 'Seven', 88, 'female', 'Houston', 'USA', 'Texas'),
(15, 'Tade Row', 'Four', 88, 'male', 'Beawar', 'IND', 'Rajasthan'),
(16, 'Gimmy', 'Four', 88, 'male', 'Glasgow', 'GBR', 'Scotland'),
(17, 'Tumyu', 'Six', 54, 'male', 'Coimbatore', 'IND', 'Tamil Nadu'),
(18, 'Honny', 'Five', 75, 'male', 'Surrey', 'CAN', 'British Colombia'),
(19, 'Tinny', 'Nine', 18, 'male', 'Gondiya', 'IND', 'Maharashtra'),
(20, 'Jackly', 'Nine', 65, 'female', 'San Jose', 'USA', 'California'),
(21, 'Babby John', 'Four', 69, 'female', 'Ahmedabad', 'IND', 'Gujarat'),
(22, 'Reggid', 'Seven', 55, 'female', 'Cape Breton', 'CAN', 'Nova Scotia'),
(23, 'Herod', 'Eight', 79, 'male', 'Bhind', 'IND', 'Madhya Pradesh'),
(24, 'Tiddy Now', 'Seven', 78, 'male', 'Liverpool', 'GBR', 'England'),
(25, 'Giff Tow', 'Seven', 88, 'male', 'Pune', 'IND', 'Maharashtra'),
(26, 'Crelea', 'Seven', 79, 'male', 'Saint John´s', 'CAN', 'Newfoundland'),
(27, 'Big Nose', 'Three', 81, 'female', 'Jacksonville', 'USA', 'Florida'),
(28, 'Rojj Base', 'Seven', 86, 'female', 'Surat', 'IND', 'Gujarat'),
(29, 'Tess Played', 'Seven', 55, 'male', 'Cleveland', 'USA', 'Ohio'),
(30, 'Reppy Red', 'Six', 79, 'female', 'Seattle', 'USA', 'Washington'),
(31, 'Marry Toeey', 'Four', 88, 'male', 'Regina', 'CAN', 'Saskatchewan'),
(32, 'Binn Rott', 'Seven', 90, 'female', 'Edinburgh', 'GBR', 'Scotland'),
(33, 'Kenn Rein', 'Six', 96, 'female', 'Kalyan', 'IND', 'Maharashtra'),
(34, 'Gain Toe', 'Seven', 69, 'male', 'Tucson', 'USA', 'Arizona'),
(35, 'Rows Noump', 'Six', 88, 'female', 'Jaipur', 'IND', 'Rajasthan');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
