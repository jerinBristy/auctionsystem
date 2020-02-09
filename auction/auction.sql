-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2018 at 03:10 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidson`
--

CREATE TABLE `bidson` (
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `ownbid` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidson`
--

INSERT INTO `bidson` (`userid`, `itemid`, `ownbid`) VALUES
(9, 1, 51000),
(10, 4, 41000);

-- --------------------------------------------------------

--
-- Table structure for table `bidstats`
--

CREATE TABLE `bidstats` (
  `itemid` int(11) NOT NULL,
  `highestbid` double DEFAULT NULL,
  `highestbidder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidstats`
--

INSERT INTO `bidstats` (`itemid`, `highestbid`, `highestbidder`) VALUES
(1, 51000, 9),
(4, 41000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ownerid` int(11) NOT NULL,
  `startingbid` double NOT NULL,
  `duration` date NOT NULL,
  `pic1` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemid`, `name`, `description`, `ownerid`, `startingbid`, `duration`, `pic1`) VALUES
(1, 'mobile phone', 'iphone X', 8, 50000, '2017-12-30', 'itempic/5a1f696f7e8147.39369267.jpg'),
(2, 'cycle', 'mountain bike', 9, 15000, '2017-12-30', 'itempic/5a1f69ce684e49.42505683.jpg'),
(3, 'spideman', 'homecoming', 9, 500, '2017-12-30', 'itempic/5a1f70be3f0114.38030722.jpg'),
(4, 'Laptop', 'lenovo', 9, 40000, '2017-12-30', 'itempic/5a1f781db19870.31445474.png'),
(5, 'camera', 'nikon', 9, 60000, '2018-01-13', 'itempic/5a1f784e23e5b1.17117843.jpg'),
(8, 'qwert', 'kjgfkjgulg', 8, 200, '2017-10-12', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pass` varchar(10000) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profilepic` varchar(1000) NOT NULL DEFAULT 'profile/0.png',
  `adminflag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `pass`, `phone`, `address`, `email`, `profilepic`, `adminflag`) VALUES
(7, 'Asif Imran', '$2y$10$4s4sNjeZsbIUDhnyV1.veeT0H/Mi0nm3FKHNUp1PiB1SqkVM10b2y', '01689284587', 'mohakhali,dhaka', 'shakilnadim@gmail.com', 'profile/7.jpg', 1),
(8, 'Israt Jerin Bristy', '$2y$10$9/CP13EQW1QyBqnyyA7Y9ePZujnHj9nyeOkkQko4QMGEyQvoUJIUa', '01684368881', 'banasree,dhaka', 'ijerin111@gmail.com', 'profile/8.jpg', 0),
(9, 'Farhana Yasmeen', '$2y$10$PSUTN6lIWc5Jg3P.aKL.luB3E1VXR9X.peycc0TKOzCOFLJ4OI.92', '01719007632', 'farmgate, dhaka', 'farhana@gmail.com', 'profile/9.jpg', 0),
(10, 'Sadia Tanjim', '$2y$10$W4wnBHZYVO64xwvGsTBjA.V6iK7Vshm5ywL/Q3oo5qaI4wTTXNvii', '01534209358', 'farmgate, dhaka', 'sadia@gmail.com', 'profile/0.png', 0),
(11, 'tawhid anwar', '$2y$10$TE9kkQcsEVhj6b4tt9x22ubYuhgtDsiL5NMZSsIRI3EZmPpgrp40O', '0168835889', 'mirpur', 'tawhid@gmail.com', 'profile/11.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidson`
--
ALTER TABLE `bidson`
  ADD PRIMARY KEY (`userid`,`itemid`),
  ADD KEY `bidson_ibfk_2` (`itemid`);

--
-- Indexes for table `bidstats`
--
ALTER TABLE `bidstats`
  ADD PRIMARY KEY (`itemid`),
  ADD KEY `bidstats_ibfk_2` (`highestbidder`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemid`),
  ADD KEY `ownerid` (`ownerid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidson`
--
ALTER TABLE `bidson`
  ADD CONSTRAINT `bidson_ibfk_2` FOREIGN KEY (`itemid`) REFERENCES `item` (`itemid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bidstats`
--
ALTER TABLE `bidstats`
  ADD CONSTRAINT `bidstats_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `item` (`itemid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bidstats_ibfk_2` FOREIGN KEY (`highestbidder`) REFERENCES `user` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`ownerid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
