-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2022 at 06:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online voting system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MI` varchar(5) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `CandidateID` int(11) NOT NULL,
  `ElectionID` int(11) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `fName` varchar(255) NOT NULL,
  `mName` varchar(11) NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `PositionID` int(11) NOT NULL,
  `partylist` int(11) NOT NULL,
  `Platform` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `ID` int(11) NOT NULL,
  `DepartmentName` varchar(255) DEFAULT 'No Department',
  `ElectionID` int(11) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `ElectionID` int(11) NOT NULL,
  `Admin_ID` int(11) NOT NULL,
  `ElectionName` varchar(100) NOT NULL,
  `Start` datetime NOT NULL DEFAULT current_timestamp(),
  `End` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partylist`
--

CREATE TABLE `partylist` (
  `ID` int(11) NOT NULL,
  `partylistname` varchar(255) NOT NULL DEFAULT 'No Partylist',
  `ElectionID` int(11) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `positionID` int(11) NOT NULL,
  `ElectionID` int(11) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Max_Vote` int(11) NOT NULL,
  `Priority` int(11) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `WinnersCount` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voted`
--

CREATE TABLE `voted` (
  `ID` int(11) NOT NULL,
  `VoterID` varchar(255) NOT NULL,
  `ElectionID` int(11) NOT NULL,
  `CandidateID` int(11) NOT NULL,
  `pos_id` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `VoterID` int(11) NOT NULL,
  `ElectionId` int(11) NOT NULL,
  `fName` varchar(100) NOT NULL,
  `mName` varchar(100) NOT NULL,
  `lName` varchar(100) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `Username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`CandidateID`),
  ADD KEY `POSITIONID` (`PositionID`),
  ADD KEY `id` (`ElectionID`),
  ADD KEY `pid` (`partylist`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ed` (`ElectionID`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`ElectionID`),
  ADD KEY `AdminID` (`Admin_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `partylist`
--
ALTER TABLE `partylist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `elecID` (`ElectionID`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`positionID`),
  ADD KEY `Election` (`ElectionID`);

--
-- Indexes for table `voted`
--
ALTER TABLE `voted`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `vID` (`VoterID`),
  ADD KEY `eID` (`ElectionID`),
  ADD KEY `dID` (`DepartmentID`),
  ADD KEY `cID` (`CandidateID`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`VoterID`),
  ADD KEY `ElectionID` (`ElectionId`),
  ADD KEY `depID` (`DepartmentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `CandidateID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `ElectionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partylist`
--
ALTER TABLE `partylist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `positionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voted`
--
ALTER TABLE `voted`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `VoterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `POSITIONID` FOREIGN KEY (`PositionID`) REFERENCES `position` (`positionID`),
  ADD CONSTRAINT `id` FOREIGN KEY (`ElectionID`) REFERENCES `election` (`ElectionID`),
  ADD CONSTRAINT `pid` FOREIGN KEY (`partylist`) REFERENCES `partylist` (`ID`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `ed` FOREIGN KEY (`ElectionID`) REFERENCES `election` (`ElectionID`);

--
-- Constraints for table `election`
--
ALTER TABLE `election`
  ADD CONSTRAINT `AdminID` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `partylist`
--
ALTER TABLE `partylist`
  ADD CONSTRAINT `elecID` FOREIGN KEY (`ElectionID`) REFERENCES `election` (`ElectionID`);

--
-- Constraints for table `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `Election` FOREIGN KEY (`ElectionID`) REFERENCES `election` (`ElectionID`);

--
-- Constraints for table `voter`
--
ALTER TABLE `voter`
  ADD CONSTRAINT `ElectionID` FOREIGN KEY (`ElectionId`) REFERENCES `election` (`ElectionID`),
  ADD CONSTRAINT `depID` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
