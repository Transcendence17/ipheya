-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2017 at 11:27 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipheya`
--

-- --------------------------------------------------------

--
-- Table structure for table `repairrequest`
--

CREATE TABLE `repairrequest` (
  `RequestID` int(11) NOT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `ServiceID` int(11) DEFAULT NULL,
  `Description` text,
  `RequestDate` date DEFAULT NULL,
  `RequestStatus` varchar(50) DEFAULT NULL,
  `SurveyingDate` date DEFAULT NULL,
  `RequestType` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `repairrequest`
--
ALTER TABLE `repairrequest`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `ClientID` (`ClientID`),
  ADD KEY `ServiceID` (`ServiceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `repairrequest`
--
ALTER TABLE `repairrequest`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
