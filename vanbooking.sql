-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 06:03 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vanbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `journey`
--

CREATE TABLE `journey` (
  `id` int(11) NOT NULL,
  `van_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `jdate` date DEFAULT NULL,
  `bookdate` timestamp NULL DEFAULT current_timestamp(),
  `approval` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journey`
--

INSERT INTO `journey` (`id`, `van_id`, `seat_id`, `user_id`, `jdate`, `bookdate`, `approval`, `admin_id`) VALUES
(1, 2, 1, 2, '2022-06-10', '2022-06-10 06:22:58', 0, 1),
(2, 2, 2, 2, '2022-06-15', '2022-06-10 09:59:02', NULL, NULL),
(3, 2, 3, 2, '2022-06-12', '2022-06-10 10:01:58', 0, 1),
(4, 2, 4, 2, '2022-06-10', '2022-06-10 10:02:46', 0, 1),
(5, 2, 5, 2, '2022-06-17', '2022-06-10 10:03:15', 0, 1),
(6, 2, 6, 2, '2022-06-14', '2022-06-10 10:40:46', 1, 1),
(7, 2, 1, 2, '2022-06-14', '2022-06-10 10:42:43', 1, 1),
(8, 2, 1, 2, '2022-06-10', '2022-06-10 15:19:24', 1, 1),
(9, 2, 2, 2, '2022-06-10', '2022-06-10 15:43:06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id` int(11) NOT NULL,
  `seat` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id`, `seat`) VALUES
(1, 'SEAT 1'),
(2, 'SEAT 2'),
(3, 'SEAT 3'),
(4, 'SEAT 4'),
(5, 'SEAT 5'),
(6, 'SEAT 6'),
(7, 'SEAT 7'),
(8, 'SEAT 8'),
(9, 'SEAT 9'),
(10, 'SEAT 10'),
(11, 'SEAT 11'),
(12, 'SEAT 12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` varchar(20) DEFAULT NULL,
  `pword` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `level` int(1) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `pword`, `fname`, `level`) VALUES
(1, 'suhardi', '123', 'Suhardi Bin Hamid', 1),
(2, 'user1', '123', 'User 1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `van`
--

CREATE TABLE `van` (
  `id` int(11) NOT NULL,
  `plate` varchar(6) DEFAULT NULL,
  `make` varchar(20) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `van`
--

INSERT INTO `van` (`id`, `plate`, `make`, `year`) VALUES
(1, 'ADD111', 'Toyota', 2000),
(2, 'KAD222', 'Toyota', 2010);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `journey`
--
ALTER TABLE `journey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `van_id` (`van_id`),
  ADD KEY `seat_id` (`seat_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van`
--
ALTER TABLE `van`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `journey`
--
ALTER TABLE `journey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `van`
--
ALTER TABLE `van`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `journey`
--
ALTER TABLE `journey`
  ADD CONSTRAINT `journey_ibfk_1` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `journey_ibfk_2` FOREIGN KEY (`van_id`) REFERENCES `van` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `journey_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `journey_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
