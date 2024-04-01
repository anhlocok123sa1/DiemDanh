-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2024 at 05:37 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

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
-- Table structure for table `mon_hoc`
--

DROP TABLE IF EXISTS `mon_hoc`;
CREATE TABLE IF NOT EXISTS `mon_hoc` (
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaMH` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`MaMH`),
  UNIQUE KEY `MaMH` (`MaMH`),
  KEY `MaMH_2` (`MaMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mon_hoc`
--

INSERT INTO `mon_hoc` (`Name`, `MaMH`) VALUES
('Triển khai hệ thống thông tin', 'CS03042'),
('Xây dựng phần mềm Web', 'CS03043'),
('AI cơ bản và ứng dụng', 'CS03057'),
('Thực tập tốt nghiệp', 'CS03151');

-- --------------------------------------------------------

--
-- Table structure for table `table_attendance`
--

DROP TABLE IF EXISTS `table_attendance`;
CREATE TABLE IF NOT EXISTS `table_attendance` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `STUDENTID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NAME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CLASS` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TIMEIN` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaMH` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `STUDENTID` (`STUDENTID`),
  KEY `MaMH` (`MaMH`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_attendance`
--

INSERT INTO `table_attendance` (`ID`, `STUDENTID`, `NAME`, `CLASS`, `TIMEIN`, `MaMH`) VALUES
(8, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-02 00:19:26', 'CS03042'),
(9, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-02 00:21:16', 'CS03043'),
(10, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-02 00:23:35', 'CS03043'),
(11, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-02 00:24:06', 'CS03042');

-- --------------------------------------------------------

--
-- Table structure for table `table_student`
--

DROP TABLE IF EXISTS `table_student`;
CREATE TABLE IF NOT EXISTS `table_student` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `STUDENTID` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Class` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaMH` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `STUDENTID` (`STUDENTID`),
  KEY `MaMH` (`MaMH`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_student`
--

INSERT INTO `table_student` (`ID`, `STUDENTID`, `Name`, `Class`, `MaMH`) VALUES
(22, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', 'CS03042'),
(23, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', 'CS03043'),
(24, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', 'CS03043'),
(25, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', 'CS03042');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cpassword` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL,
  `STUDENTID` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NAME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CLASS` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`STUDENTID`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `STUDENTID` (`STUDENTID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `cpassword`, `date`, `STUDENTID`, `NAME`, `CLASS`) VALUES
(16, 'DH52001727', '612adde8b927cd69ad941b52455e8172', '', '2024-04-01 21:27:08', 'DH52001727', 'Lê Lâm Tấn Lộc', 'D20_TH02');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_attendance`
--
ALTER TABLE `table_attendance`
  ADD CONSTRAINT `table_attendance_ibfk_1` FOREIGN KEY (`MaMH`) REFERENCES `mon_hoc` (`MaMH`);

--
-- Constraints for table `table_student`
--
ALTER TABLE `table_student`
  ADD CONSTRAINT `table_student_ibfk_1` FOREIGN KEY (`STUDENTID`) REFERENCES `user` (`STUDENTID`),
  ADD CONSTRAINT `table_student_ibfk_2` FOREIGN KEY (`MaMH`) REFERENCES `mon_hoc` (`MaMH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
