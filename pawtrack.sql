-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2025 at 07:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pawtrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` varchar(10) NOT NULL,
  `AdminFName` varchar(50) NOT NULL,
  `AdminSName` varchar(50) NOT NULL,
  `AdminEmail` varchar(50) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  `AdminLog` varchar(50) DEFAULT NULL,
  `AdminStartDate` date NOT NULL DEFAULT current_timestamp(),
  `AdminPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminFName`, `AdminSName`, `AdminEmail`, `AdminPassword`, `AdminLog`, `AdminStartDate`, `AdminPic`) VALUES
('A001', 'Julia', 'Abigail', 'julia.abigail@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2023-05-10', 'admin1.png'),
('A002', 'Dino', 'Borrinaga', 'dino.borrinaga@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2024-01-22', 'admin2.png');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ClientID` varchar(10) NOT NULL,
  `AdminID` varchar(10) NOT NULL,
  `ClientFName` varchar(50) NOT NULL,
  `ClientLName` varchar(50) NOT NULL,
  `ClientEmail` varchar(50) NOT NULL,
  `ClientPassword` varchar(255) NOT NULL,
  `ClientStartDate` date NOT NULL DEFAULT current_timestamp(),
  `ClientLog` varchar(50) DEFAULT NULL,
  `ClientPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ClientID`, `AdminID`, `ClientFName`, `ClientLName`, `ClientEmail`, `ClientPassword`, `ClientStartDate`, `ClientLog`, `ClientPic`) VALUES
('C001', 'A001', 'Dino', 'Borrinaga', 'dino.borrinaga@email.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', '2024-05-11', 'Active', 'client1.png'),
('C002', 'A002', 'Julia', 'Abigail', 'julia.abigail@email.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', '2024-06-20', 'Active', 'client2.png');

-- --------------------------------------------------------

--
-- Table structure for table `medhistory`
--

CREATE TABLE `medhistory` (
  `MedHistoryID` varchar(10) NOT NULL,
  `VetID` varchar(10) NOT NULL,
  `ClientID` varchar(10) NOT NULL,
  `PetID` varchar(10) NOT NULL,
  `MedRecord` varchar(255) NOT NULL,
  `VaxRecord` varchar(255) NOT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medhistory`
--

INSERT INTO `medhistory` (`MedHistoryID`, `VetID`, `ClientID`, `PetID`, `MedRecord`, `VaxRecord`, `Date`) VALUES
('MH001', 'V001', 'C001', 'P001', 'Treated for ear infection, prescribed antibiotics.', 'Rabies (2024), Parvo (2024)', '2025-10-01'),
('MH002', 'V002', 'C002', 'P002', 'Routine check-up, healthy condition.', 'Rabies (2024), Distemper (2024)', '2025-10-03'),
('MH003', 'V001', 'C001', 'P003', 'Minor surgery for wound care.', 'Rabies (2024), Leptospirosis (2024)', '2025-10-04'),
('MH004', 'V002', 'C002', 'P004', 'Diagnosed with mild skin allergy, given ointment.', 'Rabies (2025), Parvo (2025)', '2025-10-11'),
('MH005', 'V001', 'C001', 'P001', 'Follow-up check-up, full recovery observed.', 'Booster: Rabies (2025)', '2025-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `PetID` varchar(10) NOT NULL,
  `StaffID` varchar(10) NOT NULL,
  `ClientID` varchar(10) NOT NULL,
  `PetChipNum` varchar(255) DEFAULT NULL,
  `PetName` varchar(50) NOT NULL,
  `PetPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`PetID`, `StaffID`, `ClientID`, `PetChipNum`, `PetName`, `PetPic`) VALUES
('P001', 'S001', 'C001', '985112009876543', 'Oreo', 'pet1.png'),
('P002', 'S002', 'C002', '985112009123456', 'Mochi', 'pet2.png'),
('P003', 'S002', 'C001', '985112009555555', 'Biscuit', 'pet3.png'),
('P004', 'S001', 'C002', '985112009777777', 'Nala', 'pet4.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` varchar(10) NOT NULL,
  `AdminID` varchar(10) NOT NULL,
  `StaffFName` varchar(50) NOT NULL,
  `StaffSName` varchar(50) NOT NULL,
  `StaffEmail` varchar(50) NOT NULL,
  `StaffPassword` varchar(255) NOT NULL,
  `StaffLog` varchar(50) DEFAULT NULL,
  `StaffStartDate` date NOT NULL DEFAULT current_timestamp(),
  `StaffPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `AdminID`, `StaffFName`, `StaffSName`, `StaffEmail`, `StaffPassword`, `StaffLog`, `StaffStartDate`, `StaffPic`) VALUES
('S001', 'A001', 'Paul', 'Gabriel', 'paul.gabriel@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2023-08-05', NULL),
('S002', 'A002', 'Shanen', 'Francesca', 'shanen.francesca@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2024-03-20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vet`
--

CREATE TABLE `vet` (
  `VetID` varchar(10) NOT NULL,
  `AdminID` varchar(10) NOT NULL,
  `VetFName` varchar(50) NOT NULL,
  `VetSName` varchar(50) NOT NULL,
  `VetEmail` varchar(50) NOT NULL,
  `VetPassword` varchar(255) NOT NULL,
  `VetLog` varchar(50) DEFAULT NULL,
  `VetStartDate` date NOT NULL DEFAULT current_timestamp(),
  `VetPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vet`
--

INSERT INTO `vet` (`VetID`, `AdminID`, `VetFName`, `VetSName`, `VetEmail`, `VetPassword`, `VetLog`, `VetStartDate`, `VetPic`) VALUES
('V001', 'A001', 'Shanen', 'Francesca', 'shanen.francesca@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2023-07-01', 'vet-girl.jpg'),
('V002', 'A002', 'Paul', 'Gabriel', 'paul.gabriel@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2024-02-10', 'vet-boy.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientID`),
  ADD KEY `admin_client` (`AdminID`);

--
-- Indexes for table `medhistory`
--
ALTER TABLE `medhistory`
  ADD PRIMARY KEY (`MedHistoryID`),
  ADD KEY `client_med` (`ClientID`),
  ADD KEY `pet_med` (`PetID`),
  ADD KEY `vet_med` (`VetID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`PetID`),
  ADD KEY `staff_pet` (`StaffID`),
  ADD KEY `client_pet` (`ClientID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`),
  ADD KEY `admin_staff` (`AdminID`);

--
-- Indexes for table `vet`
--
ALTER TABLE `vet`
  ADD PRIMARY KEY (`VetID`),
  ADD KEY `admin_vet` (`AdminID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `admin_client` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `medhistory`
--
ALTER TABLE `medhistory`
  ADD CONSTRAINT `client_med` FOREIGN KEY (`ClientID`) REFERENCES `client` (`ClientID`),
  ADD CONSTRAINT `pet_med` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`),
  ADD CONSTRAINT `vet_med` FOREIGN KEY (`VetID`) REFERENCES `vet` (`VetID`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `client_pet` FOREIGN KEY (`ClientID`) REFERENCES `client` (`ClientID`),
  ADD CONSTRAINT `staff_pet` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `admin_staff` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `vet`
--
ALTER TABLE `vet`
  ADD CONSTRAINT `admin_vet` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
