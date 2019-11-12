-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2019 at 02:39 AM
-- Server version: 5.6.21
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `car_expert_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE IF NOT EXISTS `apply` (
`id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `program_id` int(5) NOT NULL,
  `sitting` int(2) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `type` varchar(50) NOT NULL,
  `pin` varchar(20) NOT NULL,
  `sbj_1` varchar(20) NOT NULL,
  `sbj_1_grade` varchar(1) NOT NULL,
  `sbj_2` varchar(20) NOT NULL,
  `sbj_2_grade` varchar(1) NOT NULL,
  `sbj_3` varchar(20) NOT NULL,
  `sbj_3_grade` varchar(1) NOT NULL,
  `sbj_4` varchar(20) NOT NULL,
  `sbj_4_grade` varchar(1) NOT NULL,
  `sbj_5` varchar(20) NOT NULL,
  `sbj_5_grade` varchar(1) NOT NULL,
  `admission_status` enum('0','1') NOT NULL DEFAULT '0',
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply`
--

INSERT INTO `apply` (`id`, `user`, `program_id`, `sitting`, `reg_no`, `type`, `pin`, `sbj_1`, `sbj_1_grade`, `sbj_2`, `sbj_2_grade`, `sbj_3`, `sbj_3_grade`, `sbj_4`, `sbj_4_grade`, `sbj_5`, `sbj_5_grade`, `admission_status`, `date`) VALUES
(2, '455133', 2, 1, 'Ab-2019-2014', 'WAEC GCE', '482134', '1', '3', '1', '5', '3', '6', '1', '2', '2', '3', '0', '2019-07-23 07:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`contact_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE IF NOT EXISTS `model` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `year`) VALUES
(1, 'W203 C-Class ', 2007),
(2, 'R230 SL ', 2011),
(3, 'W211 E ', 2008),
(4, 'W414 ', 2005),
(5, 'W218 ', 2018),
(6, 'R172 SLK ', 2019),
(7, 'X166 GL ', 2016),
(8, 'W415 ', 2018),
(9, 'W176 ', 2019),
(10, 'W222 ', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
`id` int(11) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `message`) VALUES
(1, 'Have You Check The Fuel Level\r\n'),
(2, 'Have You Check Engine Steam Level');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE IF NOT EXISTS `problems` (
`id` int(11) NOT NULL,
  `symptom_id` int(5) NOT NULL,
  `problem` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`id`, `symptom_id`, `problem`) VALUES
(1, 1, 'loose heat shield that surrounds the exhaust system.'),
(2, 1, 'AC compressor clutch'),
(3, 1, 'idler pulley'),
(4, 1, ' belt tensioner'),
(5, 5, 'bad or failing heat shield'),
(6, 6, 'bad or failing heat shield');

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE IF NOT EXISTS `solutions` (
`id` int(11) NOT NULL,
  `problem_id` int(5) NOT NULL,
  `solution` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solutions`
--

INSERT INTO `solutions` (`id`, `problem_id`, `solution`) VALUES
(1, 1, ' Check the heat shields under the car for looseness and corrosion. Tighten them down if they''re loose, or get them replaced if corrosion has compromised their structural integrity. Driving without them is not an option.'),
(2, 5, ' Check the heat shields under the car for looseness and corrosion. Tighten them down if they''re loose, or get them replaced if corrosion has compromised their structural integrity. Driving without them is not an option.'),
(3, 6, ' Check the heat shields under the car for looseness and corrosion. Tighten them down if they''re loose, or get them replaced if corrosion has compromised their structural integrity. Driving without them is not an option.');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE IF NOT EXISTS `symptoms` (
`id` int(11) NOT NULL,
  `model_id` int(5) NOT NULL,
  `question` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `model_id`, `question`) VALUES
(1, 1, 'Rattling Sounds While the Vehicle''s in Idle.'),
(2, 1, 'A Misfiring Engine.'),
(3, 1, 'Metal Shavings in the Oil.'),
(4, 1, 'Engine Fails to Start.'),
(5, 1, 'Excessive heat from the engine bay'),
(6, 1, 'Burning smell');

-- --------------------------------------------------------

--
-- Table structure for table `useroptions`
--

CREATE TABLE IF NOT EXISTS `useroptions` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `background` varchar(255) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `temp_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useroptions`
--

INSERT INTO `useroptions` (`id`, `email`, `background`, `question`, `answer`, `temp_pass`) VALUES
(1, '193631', 'original', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `admission_status` enum('0','1') NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `mainemail` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `ip` varchar(50) NOT NULL,
  `signup` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `last_seen` datetime NOT NULL,
  `notescheck` datetime NOT NULL,
  `userlevel` enum('a','b','c','d','e') NOT NULL DEFAULT 'a',
  `activated` enum('0','1') NOT NULL DEFAULT '1',
  `blocked` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `admission_status`, `email`, `mainemail`, `password`, `avatar`, `ip`, `signup`, `lastlogin`, `last_seen`, `notescheck`, `userlevel`, `activated`, `blocked`) VALUES
(1, 'JcFavour', '0', '193631', 'jc.computers.ng@gmail.com', 'a127fd1f86e4ab650f2216f09992afa4', 'avatar.png', '1', '2019-08-03 13:09:46', '2019-08-09 19:57:48', '2019-08-09 19:57:48', '2019-08-03 13:09:46', 'a', '1', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solutions`
--
ALTER TABLE `solutions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useroptions`
--
ALTER TABLE `useroptions`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `solutions`
--
ALTER TABLE `solutions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
