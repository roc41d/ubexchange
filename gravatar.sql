-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2016 at 09:54 AM
-- Server version: 5.5.52-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ubexchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `gravatar`
--

CREATE TABLE IF NOT EXISTS `gravatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `gravatar`
--

INSERT INTO `gravatar` (`id`, `image`) VALUES
(1, 'image001.png'),
(2, 'image002.png'),
(3, 'image003.png'),
(4, 'image004.png'),
(5, 'image005.png'),
(6, 'image006.png'),
(7, 'image007.png'),
(8, 'image008.png'),
(9, 'image009.png'),
(10, 'image010.png'),
(11, 'image011.png'),
(12, 'image012.png'),
(13, 'image013.png'),
(14, 'image014.png'),
(15, 'image015.png'),
(16, 'image016.png'),
(17, 'image017.png'),
(18, 'image018.png'),
(19, 'image019.png'),
(20, 'image020.png'),
(21, 'image021.png'),
(22, 'image022.png'),
(23, 'image023.png'),
(24, 'image024.png'),
(25, 'image025.png'),
(26, 'image026.png'),
(27, 'image027.png'),
(28, 'image028.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
