-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2014 at 07:00 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thejaco2_moviejournal`
--
CREATE DATABASE IF NOT EXISTS `thejaco2_moviejournal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `thejaco2_moviejournal`;

-- --------------------------------------------------------

--
-- Table structure for table `cast`
--

DROP TABLE IF EXISTS `cast`;
CREATE TABLE IF NOT EXISTS `cast` (
  `movieid` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `role` varchar(100) NOT NULL,
  KEY `idx_cast` (`movieid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cast`
--

INSERT INTO `cast` (`movieid`, `firstname`, `lastname`, `role`) VALUES
(1, 'Tony Leung', 'Ka Fai', 'Shatuo Zhong'),
(1, 'Chao', 'Deng', 'Pei Donglai'),
(1, 'Carina', 'Lau', 'Empress Wu Zetian'),
(1, 'Andy', 'Lau', 'Detective Dee'),
(2, 'Jackie', 'Chan', 'Wong Fei-hung'),
(2, 'Lung', 'Ti', 'Wong Kei-ying - Wong''s Father'),
(2, 'Anita', 'Mui', 'Ling - Wong''s Step-Mother'),
(2, 'Felix', 'Wong', 'Tsang'),
(3, 'Stephen', 'Chow', 'Sing'),
(3, 'Xiaogang', 'Feng', 'Crocodile Gang Boss'),
(3, 'Wah', 'Yuen', 'Landlord');

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

DROP TABLE IF EXISTS `crew`;
CREATE TABLE IF NOT EXISTS `crew` (
  `movieid` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `position` varchar(100) NOT NULL,
  KEY `idx_crew` (`movieid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crew`
--

INSERT INTO `crew` (`movieid`, `firstname`, `lastname`, `position`) VALUES
(3, 'Sha', 'Bin', 'Art Department'),
(2, 'Bruce', 'Law', 'Special Effects'),
(1, 'Yanming', 'Jiang', 'Visual Effects Supervisor'),
(1, 'Saeed', 'Adyani', 'Still Phorographer');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `overview` varchar(255) DEFAULT NULL,
  `date_released` date DEFAULT NULL,
  `director` varchar(60) DEFAULT NULL,
  `run_length` int(11) DEFAULT NULL,
  `misc_facts` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL COMMENT 'User comments on the movie',
  UNIQUE KEY `uk_movies` (`id`),
  KEY `primary_movies` (`name`,`date_released`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `overview`, `date_released`, `director`, `run_length`, `misc_facts`, `comments`) VALUES
(1, 'Detective Dee: Mystery of the Phantom Flame', 'An exiled detective is recruited to solve a series of mysterious deaths that threaten to delay the inauguration of Empress Wu.', '2010-09-30', 'Hark Tsui', 119, NULL, NULL),
(2, 'The Legend of Drunken Master', 'A young martial artist is caught between respecting his pacifist father''s wishes or stopping a group of disrespectful foreigners from stealing precious artifacts.', '2000-10-20', 'Chia-Liang Liu', 102, NULL, NULL),
(3, 'Kung Fu Hustle', 'In Shanghai, China in the 1940s, a wannabe gangster aspires to join the notorious "Axe Gang" while residents of a housing complex exhibit extraordinary powers in defending their turf.', '2005-04-22', 'Stephen Chow', 99, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `producers`
--

DROP TABLE IF EXISTS `producers`;
CREATE TABLE IF NOT EXISTS `producers` (
  `movieid` int(11) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  KEY `uk_producers` (`movieid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producers`
--

INSERT INTO `producers` (`movieid`, `firstname`, `lastname`) VALUES
(1, 'Felice', 'Bee'),
(1, 'Peggy', 'Lee'),
(1, 'Nansun', 'Shi'),
(1, 'Hark', 'Tsui'),
(2, 'Leonard', 'Ho'),
(2, 'Edward', 'Tang'),
(2, 'Eric', 'Tsang'),
(2, 'Barbie', 'Tung');

-- --------------------------------------------------------

--
-- Table structure for table `production_companies`
--

DROP TABLE IF EXISTS `production_companies`;
CREATE TABLE IF NOT EXISTS `production_companies` (
  `movieid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  KEY `idx_production_companies` (`movieid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production_companies`
--

INSERT INTO `production_companies` (`movieid`, `name`) VALUES
(1, 'China Film Co-Production Corporation'),
(1, 'Film Workshop'),
(3, 'Columbia Pictures Film Production Asia'),
(3, 'Huayi Brothers');

-- --------------------------------------------------------

--
-- Table structure for table `usermovies`
--

DROP TABLE IF EXISTS `usermovies`;
CREATE TABLE IF NOT EXISTS `usermovies` (
  `userid` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `watched` tinyint(1) NOT NULL,
  PRIMARY KEY (`userid`,`movieid`,`watched`),
  UNIQUE KEY `movieid` (`movieid`),
  KEY `idx_usermovies` (`userid`),
  KEY `idx_usermovies_0` (`movieid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermovies`
--

INSERT INTO `usermovies` (`userid`, `movieid`, `watched`) VALUES
(1, 1, 1),
(1, 2, 0),
(2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `userpass` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `userpass`) VALUES
(1, 'brian', 'pass123'),
(2, 'stephen', 'pass123');

-- --------------------------------------------------------

--
-- Table structure for table `writers`
--

DROP TABLE IF EXISTS `writers`;
CREATE TABLE IF NOT EXISTS `writers` (
  `movieid` int(11) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  KEY `idx_writers` (`movieid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writers`
--

INSERT INTO `writers` (`movieid`, `firstname`, `lastname`) VALUES
(3, 'Stephan', 'Chow'),
(3, 'Man Keung', 'Chan'),
(3, 'Xin', 'Huo'),
(3, 'Kan-Cheung', 'Tsan'),
(2, 'Edward', 'Tang'),
(2, 'Man-Ming', 'Tong'),
(2, 'Gai Chi', 'Yuen'),
(1, 'Chia-lu', 'Chang'),
(1, 'Kuo-fu', 'Chen'),
(1, 'Lin', 'Qianyu');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cast`
--
ALTER TABLE `cast`
  ADD CONSTRAINT `fk_cast_movies` FOREIGN KEY (`movieid`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `crew`
--
ALTER TABLE `crew`
  ADD CONSTRAINT `fk_crew_movies` FOREIGN KEY (`movieid`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producers`
--
ALTER TABLE `producers`
  ADD CONSTRAINT `fk_producers_movies` FOREIGN KEY (`movieid`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `production_companies`
--
ALTER TABLE `production_companies`
  ADD CONSTRAINT `fk_production_companies_movies` FOREIGN KEY (`movieid`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usermovies`
--
ALTER TABLE `usermovies`
  ADD CONSTRAINT `fk_usermovies_movies` FOREIGN KEY (`movieid`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usermovies_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `writers`
--
ALTER TABLE `writers`
  ADD CONSTRAINT `fk_writers_movies` FOREIGN KEY (`movieid`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
