-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 04:18 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aproval`
--

CREATE TABLE `aproval` (
  `empID` int(11) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Hoadmin` tinyint(1) NOT NULL,
  `Edp` tinyint(1) NOT NULL,
  `Md` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aproval`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empID` int(11) NOT NULL,
  `employeeName` varchar(20) DEFAULT NULL,
  `designation` varchar(30) DEFAULT NULL,
  `scaleofpay` int(11) DEFAULT NULL,
  `dateofjoining` date DEFAULT NULL,
  `unit` text DEFAULT NULL,
  `department` text DEFAULT NULL,
  `credit` tinyint(1) NOT NULL,
  `purpose` text DEFAULT NULL,
  `key_id` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `insert_in_form` AFTER INSERT ON `employee` FOR EACH ROW Insert Into aproval (empID) VALUES (NEW.empID)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `empID` int(11) NOT NULL,
  `Item` varchar(30) NOT NULL,
  `Size_Specifications` varchar(30) NOT NULL,
  `Quantity` int(30) NOT NULL,
  `Amount` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'User', 'user123', 'User'),
(2, 'Admin', 'admin123', 'Admin'),
(3, 'Hoadmin', 'ho123', 'Hoadmin'),
(4, 'Edp', 'edp123', 'Edp'),
(5, 'Md', 'md123', 'Md');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aproval`
--
ALTER TABLE `aproval`
  ADD KEY `empID_2` (`empID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD KEY `empID` (`empID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aproval`
--
ALTER TABLE `aproval`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aproval`
--
ALTER TABLE `aproval`
  ADD CONSTRAINT `hello` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `fsf` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
