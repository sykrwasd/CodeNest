-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2025 at 04:35 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codenestdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminEmail` varchar(35) NOT NULL,
  `adminID` int(10) NOT NULL,
  `adminFullName` varchar(45) NOT NULL,
  `adminNoPhone` varchar(15) NOT NULL,
  `adminAddress` varchar(200) NOT NULL,
  `adminIC` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminEmail`, `adminID`, `adminFullName`, `adminNoPhone`, `adminAddress`, `adminIC`) VALUES
('admin1@nazacorp.com', 1001, 'Amir Hakim bin Salleh', '012-8453129', 'No. 45, Jalan Indah 5/3, Taman Bukit Indah, 68000 Ampang, Selangor', '900512105521'),
('admin2@nazacorp.com', 1003, 'Danial Zafran bin Azmi', '017-6632241', 'No. 19, Jalan Kenanga 8/4, Taman Kenanga, 43000 Kajang, Selangor', '920721045672'),
('admin3@nazacorp.com', 1002, 'Nurul Syafiqah binti Mohd Yusof', '013-7294438', 'No. 78, Lorong Mawar 2, Taman Seri Mawar, 75200 Melaka', '980311145839');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` varchar(45) NOT NULL,
  `departmentType` varchar(20) NOT NULL,
  `role` varchar(45) NOT NULL,
  `place` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `departmentType`, `role`, `place`) VALUES
('431018', 'Factory', 'Accounting Executive', 'idk'),
('495837', 'Service', 'Sales Manager', 'idk'),
('917575', 'Factory', 'Accounting Auditor', 'idk');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payrollID` int(15) NOT NULL,
  `salaryID` int(15) NOT NULL,
  `payDate` varchar(9) NOT NULL,
  `bonus` decimal(6,2) NOT NULL,
  `deduction` decimal(6,2) NOT NULL,
  `netsalary` decimal(6,2) NOT NULL,
  `staffID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payrollID`, `salaryID`, `payDate`, `bonus`, `deduction`, `netsalary`, `staffID`) VALUES
(211428, 283691, '0', '0.00', '0.00', '0.00', 2025698617),
(441043, 468481, '0', '0.00', '0.00', '0.00', 2025631161),
(576586, 974813, '0', '0.00', '0.00', '0.00', 2025927764);

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE `performance` (
  `performID` int(15) NOT NULL,
  `evaluatorID` int(10) NOT NULL,
  `evaluateeID` int(10) NOT NULL,
  `evaluateDate` varchar(9) NOT NULL,
  `remarks` text NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `performance`
--

INSERT INTO `performance` (`performID`, `evaluatorID`, `evaluateeID`, `evaluateDate`, `remarks`, `status`) VALUES
(393499, 2025631161, 2025631161, '2025-06-0', 'bla bla bla', 'Read'),
(930072, 1001, 2025698617, '2025-06-0', 'ni dari admin ke admin lain', 'Read');

-- --------------------------------------------------------

--
-- Table structure for table `request_updates`
--

CREATE TABLE `request_updates` (
  `requestID` varchar(10) NOT NULL,
  `inbox` text,
  `status` varchar(20) DEFAULT '0',
  `staffID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_updates`
--

INSERT INTO `request_updates` (`requestID`, `inbox`, `status`, `staffID`) VALUES
('323297', 'Application Title: [State your title here\r\n\r\nDate: 05/06/2025\r\n\r\nTo,\r\nAdministration,\r\n\r\nSir/Madam,\r\n\r\nRE: [State the purpose of your request here]\r\n\r\nRespectfully, the above matter is referred to.\r\n\r\nI, [Full Name], would like to apply for [purpose of request] for the following reasons:\r\n\r\n1. [First reason]\r\n2. [Second reason, if any]\r\n\r\nI hope this application will be given due consideration. Your cooperation is highly appreciated.\r\n\r\nThank you.\r\n\r\nYours sincerely,\r\n[Full Name]\r\n[Position / Staff ID]', 'Read', '2025631161'),
('810870', 'Application Title: [State your title here]\r\n\r\nDate: 05/06/2025\r\n\r\nTo,\r\nAdministration,\r\n\r\nSir/Madam,\r\n\r\nRE: [State the purpose of your request here]\r\n\r\nRespectfully, the above matter is referred to.\r\n\r\nI, [Full Name], would like to apply for [purpose of request] for the following reasons:\r\n\r\n1. [First reason]\r\n2. [Second reason, if any]\r\n\r\nI hope this application will be given due consideration. Your cooperation is highly appreciated.\r\n\r\nThank you.\r\n\r\nYours sincerely,\r\n[Full Name]\r\n[Position / Staff ID]', 'Unread', '2025631161'),
('849569', 'Application Title: [State your title here]\r\n\r\nDate: 05/06/2025\r\n\r\nTo,\r\nAdministration,\r\n\r\nSir/Madam,\r\n\r\nRE: [State the purpose of your request here]\r\n\r\nRespectfully, the above matter is referred to.\r\n\r\nI, [Full Name], would like to apply for [purpose of request] for the following reasons:\r\n\r\n1. [First reason]\r\n2. [Second reason, if any]\r\n\r\nI hope this application will be given due consideration. Your cooperation is highly appreciated.\r\n\r\nThank you.\r\n\r\nYours sincerely,\r\n[Full Name]\r\n[Position / Staff ID]', 'Read', '2025631161');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salaryID` int(15) NOT NULL,
  `basicSalary` decimal(6,2) NOT NULL,
  `allowance` decimal(6,2) NOT NULL,
  `staffID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salaryID`, `basicSalary`, `allowance`, `staffID`) VALUES
(283691, '3200.00', '100.00', 2025698617),
(468481, '4200.00', '100.00', 2025631161),
(974813, '3500.00', '100.00', 2025927764);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffEmail` varchar(35) NOT NULL,
  `staffID` int(10) NOT NULL,
  `staffFullName` varchar(45) NOT NULL,
  `staffNoPhone` varchar(12) NOT NULL,
  `staffAddress` varchar(70) NOT NULL,
  `staffDOB` date NOT NULL,
  `staffIC` varchar(16) NOT NULL,
  `staffHireDate` date NOT NULL,
  `staffDepartment` varchar(20) NOT NULL,
  `staffPicture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffEmail`, `staffID`, `staffFullName`, `staffNoPhone`, `staffAddress`, `staffDOB`, `staffIC`, `staffHireDate`, `staffDepartment`, `staffPicture`) VALUES
('2025631161@nazacorp.com', 2025631161, 'Hakimi Danish Roslan', '017-2947163', 'No. 8, Jalan Wira 2 Taman Cahaya Indah 43000 Selangor Malaysia', '1999-08-27', '990827145531', '2025-06-01', 'factory', 'HakimiDanishRoslan.jpg'),
('2025698617@nazacorp.com', 2025698617, 'Mariah Afiqah Zulkifli', '013-4728394', 'No. 12, Jalan Aman 3 Taman Seri Sentosa 75350 Melaka Malaysia', '2001-03-14', '010314103821', '2025-06-01', 'service', 'MariahAfiqahZulkifli.jpg'),
('2025927764@nazacorp.com', 2025927764, 'Faiz Hakimi', '013-7648590', ' No. 9, Jalan Impian Emas 2 Taman Saujana 81300 Johor Malaysia', '1995-09-03', '950903-14-5231', '2025-06-06', 'Factory', 'FaizHakimi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userEmail` varchar(35) NOT NULL,
  `userID` int(10) NOT NULL,
  `userPassword` varchar(12) NOT NULL,
  `category` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userEmail`, `userID`, `userPassword`, `category`) VALUES
('2025631161@nazacorp.com', 2025631161, '123', 'staff'),
('2025698617@nazacorp.com', 2025698617, '111', 'staff'),
('2025927764@nazacorp.com', 0, 'newuser', 'staff'),
('admin1@nazacorp.com', 1001, '111', 'admin'),
('admin2@nazacorp.com', 1003, '222', 'admin'),
('admin3@nazacorp.com', 1002, '333', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminEmail`,`adminID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payrollID`);

--
-- Indexes for table `performance`
--
ALTER TABLE `performance`
  ADD PRIMARY KEY (`performID`);

--
-- Indexes for table `request_updates`
--
ALTER TABLE `request_updates`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salaryID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffEmail`,`staffID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userEmail`,`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
