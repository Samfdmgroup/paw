-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2022 at 07:08 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pawsitivepals`
--
CREATE DATABASE IF NOT EXISTS `pawsitivepals` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pawsitivepals`;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `adminID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`adminID`, `name`, `surname`, `phone`, `email`, `type`, `password`) VALUES
(1, 'dylan', 'chan', 91739761, 'dylan@gmail.com', 'administrator', 'dylan'),
(2, 'john', 'doe', 91119111, 'john@gmail.com', 'administrator', 'john');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientID`, `name`, `surname`, `phone`, `email`, `type`, `password`) VALUES
(1, 'mary', 'lim', 92229222, 'mary@gmail.com', 'client', 'mary'),
(2, 'sally', 'tan', 93339333, 'sally@gmail.com', 'client', 'sally');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serviceID` int(10) NOT NULL,
  `ename` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `status` varchar(32) NOT NULL,
  `regularcostperday` decimal(10,2) NOT NULL,
  `rentdate` date NOT NULL,
  `returndate` date NOT NULL,
  `rentBy` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serviceID`, `ename`, `description`, `status`, `regularcostperday`, `rentdate`, `returndate`, `rentBy`) VALUES
(1, 'Olivia', 'Cleaning', 'Available', '100.00', '0000-00-00', '0000-00-00', ''),
(2, 'Ethan', 'Cleaning', 'Available', '50.00', '2022-02-20', '0000-00-00', ''),
(3, 'Ava', 'Grooming', 'Available', '40.00', '0000-00-00', '0000-00-00', ''),
(4, 'Ben', 'Grooming', 'Available', '199.00', '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `History`
--

CREATE TABLE `History` (
  `serviceID` int(10) NOT NULL,
  `ename` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `status` varchar(32) NOT NULL,
  `regularcostperday` decimal(10,2) NOT NULL,
  `rentdate` date NOT NULL,
  `returneddate` date NULL,
  `rentBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `History`
--

INSERT INTO `History` (`serviceID`, `ename`, `description`, `status`, `regularcostperday`, `rentdate`, `returneddate`, `rentBy`) VALUES
(2, 'Ethan', 'Cleaning', 'Available', '50.00', '2022-02-20', '2022-02-20', 'sally'),
(4, 'Ben', 'Grooming', 'Available', '199.00', '2022-02-20', '2022-02-20', 'mary');
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
