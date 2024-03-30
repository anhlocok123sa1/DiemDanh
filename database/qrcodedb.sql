-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2021 at 04:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrcodedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_attendance`
--

CREATE TABLE `table_attendance` (
  `ID` int(11) NOT NULL,
  `STUDENTID` varchar(250) NOT NULL,
  `TIMEIN` varchar(250) NOT NULL,
  `TIMEOUT` varchar(250) NOT NULL,
  `LOGDATE` varchar(250) NOT NULL,
  `AM` varchar(250) NOT NULL,
  `PM` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_attendance`
--

INSERT INTO `table_attendance` (`ID`, `STUDENTID`, `TIMEIN`, `TIMEOUT`, `LOGDATE`, `AM`, `PM`) VALUES
(69, 'Andres P. Jario', '2021-04-09 11:53:17', '', '', '', ''),
(70, 'ABC123456789', '2021-04-09 11:58:29', '', '', '', ''),
(71, 'Andres P. Jario', '2021-04-09 11:58:48', '', '', '', ''),
(72, 'Crischel T. Amorio', '2021-04-09 11:59:03', '', '', '', ''),
(73, 'Source Code PH', '2021-04-09 12:02:46', '', '', '', ''),
(74, 'Crischel T. Amorio', '2021-04-09 12:03:06', '', '', '', ''),
(75, 'Andres P. Jario', '2021-04-09 12:03:23', '', '', '', ''),
(76, 'Andres P. Jario', '2021-04-16 06:03:02', '', '', '', ''),
(77, 'Andres P. Jario', '2021-04-20 19:45:23', '', '', '', ''),
(78, 'Source Code PH', '2021-04-21 14:35:19', '', '', '', ''),
(79, 'Crischel T. Amorio', '2021-04-21 14:35:34', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_student`
--

CREATE TABLE `table_student` (
  `ID` int(11) NOT NULL,
  `STUDENTID` varchar(250) NOT NULL,
  `FIRSTNAME` varchar(250) NOT NULL,
  `MNAME` varchar(250) NOT NULL,
  `LASTNAME` varchar(250) NOT NULL,
  `AGE` varchar(250) NOT NULL,
  `GENDER` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_student`
--

INSERT INTO `table_student` (`ID`, `STUDENTID`, `FIRSTNAME`, `MNAME`, `LASTNAME`, `AGE`, `GENDER`) VALUES
(1, '1122312', '', '', '', '', ''),
(2, 'Andres P. Jario', '', '', '', '', ''),
(3, 'Crischel T. Amorio', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_attendance`
--
ALTER TABLE `table_attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_student`
--
ALTER TABLE `table_student`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_attendance`
--
ALTER TABLE `table_attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `table_student`
--
ALTER TABLE `table_student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
