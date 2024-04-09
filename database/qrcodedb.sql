-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 05, 2024 at 12:41 AM
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
-- Table structure for table `diem_danh`
--

DROP TABLE IF EXISTS `diem_danh`;
CREATE TABLE IF NOT EXISTS `diem_danh` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_lop` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TIMEIN` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_mon_hoc` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `MaMH` (`ma_mon_hoc`),
  KEY `STUDENTID` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diem_danh`
--

INSERT INTO `diem_danh` (`ID`, `student_id`, `ten`, `ma_lop`, `TIMEIN`, `ma_mon_hoc`) VALUES
(17, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-02 20:18:11', 'CS03042'),
(18, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-02 20:18:20', 'CS03043'),
(19, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-02 20:18:26', 'CS03057'),
(20, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-03 21:20:20', 'CS03042'),
(21, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-03 21:20:27', 'CS03043'),
(22, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-03 21:20:35', 'CS03057'),
(23, 'DH52001727', 'Le Lam Tan Loc', 'D20_TH02', '2024-04-03 21:20:47', 'CS03042');

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

DROP TABLE IF EXISTS `lop`;
CREATE TABLE IF NOT EXISTS `lop` (
  `ma_lop` varchar(10) NOT NULL,
  `ten_lop` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_lop`),
  UNIQUE KEY `ma_lop` (`ma_lop`),
  KEY `ma_lop_2` (`ma_lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`ma_lop`, `ten_lop`) VALUES
('D20_TH01', 'Tin học 1 năm 2020-2024'),
('D20_TH02', 'Tin học 2 năm 2020-2024');

-- --------------------------------------------------------

--
-- Table structure for table `mon_hoc`
--

DROP TABLE IF EXISTS `mon_hoc`;
CREATE TABLE IF NOT EXISTS `mon_hoc` (
  `ten_mon_hoc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_mon_hoc` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_mon_hoc`),
  UNIQUE KEY `MaMH` (`ma_mon_hoc`),
  KEY `MaMH_2` (`ma_mon_hoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mon_hoc`
--

INSERT INTO `mon_hoc` (`ten_mon_hoc`, `ma_mon_hoc`) VALUES
('Triển khai hệ thống thông tin	', 'CS03042'),
('Xây dựng phần mềm Web	', 'CS03043'),
('AI cơ bản và ứng dụng	', 'CS03057');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cpassword` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL,
  `student_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_lop` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `STUDENTID` (`student_id`),
  KEY `ma_lop` (`ma_lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `cpassword`, `date`, `student_id`, `ten`, `ma_lop`) VALUES
('admin', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '2024-04-02 13:10:26', '', '', 'D20_TH02'),
('DH52001727', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '2024-04-02 13:10:26', 'DH52001727', 'Lê Lâm Tấn Lộc', 'D20_TH02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lop`
--
ALTER TABLE `lop` ADD FULLTEXT KEY `ma_lop_4` (`ma_lop`);

--
-- Indexes for table `user`
--
ALTER TABLE `user` ADD FULLTEXT KEY `ma_lop_2` (`ma_lop`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diem_danh`
--
ALTER TABLE `diem_danh`
  ADD CONSTRAINT `diem_danh_ibfk_1` FOREIGN KEY (`ma_mon_hoc`) REFERENCES `mon_hoc` (`ma_mon_hoc`),
  ADD CONSTRAINT `diem_danh_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `user` (`student_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`ma_lop`) REFERENCES `lop` (`ma_lop`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
